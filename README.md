# addressor
Search address on map / Get address from map by pointing using Google Places. The address can be with one click saved to the database with anti-redundant principle.

## Installation
Nette directories & bash scripts:  
`chmod a+w src/temp src/log tests/tmp`  
`chmod +x bin/*`  

### PHP packages:  
`composer install`  

### Node.js packages:  
`npm install`  

### Bower packages:  
`bower install`  

### Database:  
`cp src/app/config/config.local.sample.neon src/app/config/config.local.neon`  
Edit username, password and database name in config.local.neon.  
Then create empty database.  
Create tables:  
`./bin/r.sh orm:schema-tool:create`  
Import countries to database - from the res/countries.sql file.  

### That's all!
