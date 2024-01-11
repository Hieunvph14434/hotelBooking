# Environment settings
if [ ! -f .env ]; then
echo "=== Copy .env  ==="
cp .env.example .env
echo "=== Copy is done!  ==="
echo "==== Generating the app key ==="
docker-compose run app php artisan key:generate
echo "==== App key generating is done!! ==="
fi

echo "=== Execute docker-compose build... ==="
docker-compose build
echo "=== docker-compose build is done!! ==="

# Install & Update composer
if [ -z "$(ls -A vendor)" ]; then
echo "=== Installing composer... ==="
docker-compose run app composer install
echo "=== Composer build is done!! ==="
else
echo "=== Update composer... ==="
docker-compose run app composer update --no-plugins --no-scripts
echo "=== Composer build is done!! ==="
fi

echo "==== Migrating and seed database ==="
docker-compose run app php artisan migrate
echo "==== Migrating and seed database is done!! ==="

echo "=== Execute docker-compose up... ==="
docker-compose up -d
echo "=== docker-compose up is done!! ==="
