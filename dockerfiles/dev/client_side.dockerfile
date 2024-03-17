FROM node:21.7.0-alpine3.19

WORKDIR /var/www/app

COPY ./app/package.json .

RUN npm install

COPY ./app .

CMD [ "yarn", "dev" ]