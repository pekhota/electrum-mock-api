FROM webdevops/php-nginx:7.1

# put project inside a container
COPY . /app

# let nginx know where index.php is located
ENV WEB_DOCUMENT_ROOT=/app/public
ENV ELECTRUM_BALANCE="0"
ENV ELECTRUM_ADDRESS_BALANCE_CONFIRMED="0"
ENV ELECTRUM_ADDRESS_BALANCE_UNCONFIRMED="0"

# http port
EXPOSE 80

# cd /app
WORKDIR /app

# install php dependencies
RUN composer install