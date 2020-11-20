FROM php:7.4-apache

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e \
        's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
        ${APACHE_CONFDIR}/sites-available/*.conf && \
    sed -ri -e \
        's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
        ${APACHE_CONFDIR}/apache2.conf /etc/apache2/conf-available/*.conf

RUN pecl install -f xdebug \
&& echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini;

