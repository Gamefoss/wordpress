FROM node:14-slim as builder
WORKDIR /var/www/html
COPY ./src/ ./src
COPY package*.json ./
COPY gulpfile.ts ./
COPY tsconfig.json ./
COPY .npmrc ./
RUN npm ci
RUN npm run build

FROM alpine/git:latest as plugins
WORKDIR /var/www/html
RUN git clone https://github.com/AdvancedCustomFields/acf.git

FROM wordpress:latest as wordpress
WORKDIR /var/www/html
COPY --from=builder /var/www/html/wp-content/themes ./wp-content/themes
COPY --from=plugins /var/www/html/acf ./wp-content/plugins/acf
COPY ./wp-config.php ./
COPY env.ini ./
