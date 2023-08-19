FROM nginx:1.21.1

LABEL version="0.1"
LABEL description="Nginx Football API - Test Front-End"

RUN apt-get update && \
    apt-get upgrade -y && \
    rm -rf /var/lib/apt/lists/*

## Set Owner cache
RUN chown -R nginx:nginx /var/cache/nginx/

## Set Owner PID file & directory content ##
RUN touch /var/run/nginx.pid && \
    chown -R nginx:nginx /var/run/nginx.pid && \
    chown -R nginx:nginx /usr/share/nginx/html/

## Copy Project ##
COPY . /usr/share/nginx/html/
WORKDIR /usr/share/nginx/html/

## Copy VHOST Conf ##
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/
RUN chown -R nginx:nginx /etc/nginx/conf.d/default.conf

USER nginx

EXPOSE 8082

CMD ["nginx", "-g", "daemon off;"]