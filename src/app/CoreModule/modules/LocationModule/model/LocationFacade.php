<?php

namespace Location\Model;

use Core\Model\BaseFacade;
use Kdyby\Doctrine\EntityManager;
use Kdyby\Doctrine\EntityRepository;


/**
 * Class LocationFacade
 *
 * @author Petr Blazicek 2016
 */
class LocationFacade extends BaseFacade
{

	const DATA_MIN_LENGTH = 2;


	public function __construct( EntityManager $em )
	{
		parent::__construct( $em );
	}


	/**
	 * Searches / creates Country entity
	 * 
	 * @param string $code 2 char country code
	 * @return Country
	 */
	public function getCountry( $code )
	{
		if ( strlen( $code ) != self::DATA_MIN_LENGTH ) return NULL;
		return $this->em->getRepository( Country::class )->findOneBy( [ 'codeAlpha2' => $code ] );
	}


	/**
	 * Searches / creates Region entity
	 * 
	 * @param string $name
	 * @param string $code
	 * @return Region
	 */
	public function getRegion( $name, $code )
	{
		if ( strlen( $name ) < self::DATA_MIN_LENGTH ) return NULL;

		$region = $this->em->getRepository( Region::class )
				->findOneBy( [ 'name' => $name, 'country.codeAlpha2' => $code ] ) ?: new Region( $name,
																					 $this->getCountry( $code ) );
		$this->saveAll( $region );

		return $region;
	}


	/**
	 * Searches / creates City entity
	 * 
	 * @param string $name
	 * @return City
	 */
	public function getCity( $name )
	{
		if ( strlen( $name ) < self::DATA_MIN_LENGTH ) return NULL;

		$city = $this->em->getRepository( City::class )->findOneBy( [ 'name' => $name ] )
				?: new City( $name );
		$this->saveAll( $city );

		return $city;
	}


	/**
	 * Searches / creates Postal entity
	 * 
	 * @param string $code
	 * @return Postal
	 */
	public function getPostal( $code )
	{
		if ( strlen( $code ) < self::DATA_MIN_LENGTH ) return NULL;

		$postal = $this->em->getRepository( Postal::class )->findOneBy( [ 'code' => $code ] )
				?: new Postal( $code );
		$this->saveAll( $postal );

		return $postal;
	}


	/**
	 * Searches / creates District entity
	 * 
	 * @param string $name
	 * @return District
	 */
	public function getDistrict( $name )
	{
		if ( strlen( $name ) < self::DATA_MIN_LENGTH ) return NULL;

		$district = $this->em->getRepository( District::class )->findOneBy( [ 'name' => $name ] )
				?: new District( $name );
		$this->saveAll( $district );

		return $district;
	}


	/**
	 * Searches / creates Part entity
	 * 
	 * @param string $name
	 * @return Part
	 */
	public function getPart( $name )
	{
		if ( strlen( $name ) < self::DATA_MIN_LENGTH ) return NULL;

		$part = $this->em->getRepository( Part::class )->findOneBy( [ 'name' => $name ] )
				?: new Part( $name );
		$this->saveAll( $part );

		return $part;
	}


	/**
	 * Searches / creates Street entity
	 * 
	 * @param string $name
	 * @return Street
	 */
	public function getStreet( $name )
	{
		if ( strlen( $name ) < self::DATA_MIN_LENGTH ) return NULL;

		$street = $this->em->getRepository( Street::class )->findOneBy( [ 'name' => $name ] )
				?: new Street( $name );
		$this->saveAll( $street );

		return $street;
	}


	/**
	 * Searches / creates Area entity
	 * 
	 * @param array $data
	 * @return Area
	 */
	public function getArea( $data )
	{
		$region = $this->getRegion( $data[ 'region' ], $data[ 'country' ] );
		$city = $this->getCity( $data[ 'city' ] );
		$postal = $this->getPostal( $data[ 'postal' ] );
		$district = $this->getDistrict( $data[ 'district' ] );
		$part = $this->getPart( $data[ 'part' ] );
		$street = $this->getStreet( $data[ 'street' ] );

		$qb = $this->em->getRepository( Area::class )->createQueryBuilder( 'a' );

		$qb->where( 'a.region = :region' )
			->andWhere( 'a.city = :city' )
			->andWhere( 'a.postal = :postal OR a.postal IS NULL' )
			->andWhere( 'a.district = :district OR a.district IS NULL' )
			->andWhere( 'a.part = :part OR a.part IS NULL' )
			->andWhere( 'a.street = :street OR a.street IS NULL' )
			->setParameters( [
				'region'	 => $region,
				'city'		 => $city,
				'postal'	 => $postal,
				'district'	 => $district,
				'part'		 => $part,
				'street'	 => $street,
			] );

		if ( !$area = $qb->getQuery()->getOneOrNullResult() ) {
			$area = new Area();
			$area->setRegion( $region )->setCity( $city )->setPostal( $postal )
				->setDistrict( $district )->setPart( $part )->setStreet( $street );
			$this->saveAll( $area );
		}

		return $area;
	}


	/**
	 * Searches / creates Address entity
	 * 
	 * @param array $data
	 * @return Address
	 */
	public function getAddress( $data )
	{
		$area = $this->getArea( $data );

		$regNr = $data[ 'reg_nr' ] ?: NULL;
		$houseNr = $data[ 'house_nr' ] ?: NULL;

		$qb = $this->em->getRepository( Address::class )->createQueryBuilder( 'a' );

		$qb->where( 'a.area = :area' )
			->andWhere( 'a.regNr = :reg_nr OR a.regNr IS NULL' )
			->andWhere( 'a.houseNr = :house_nr OR a.houseNr IS NULL' )
			->setParameters( [
				'area'		 => $area,
				'reg_nr'	 => $regNr,
				'house_nr'	 => $houseNr,
			] );

		if ( !$address = $qb->getQuery()->getOneOrNullResult() ) {
			$address = new Address( $area, $regNr, $houseNr );
			$this->saveAll( $address );
		}

		return $address;
	}


}
