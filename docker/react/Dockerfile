FROM node:18.17.0

LABEL version="0.1"
LABEL description="React Football - Test Front-End"

RUN apt-get update && \
    apt-get upgrade -y && \
    rm -rf /var/lib/apt/lists/*

WORKDIR /app

# add `/app/node_modules/.bin` to $PATH
ENV PATH /app/node_modules/.bin:$PATH

# install app dependencies
COPY ./front/package.json ./
COPY ./front/package-lock.json ./
RUN npm install --silent
RUN npm install react-scripts@3.4.1 -g --silent

# copy project #
COPY ./front /app

RUN chown -R node:node ./

USER node
EXPOSE 3000

# start app
CMD ["npm", "start"]