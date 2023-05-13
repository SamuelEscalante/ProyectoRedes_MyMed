FROM node

EXPOSE 3002

WORKDIR /micromedic

COPY controllers /micromedic/controllers
COPY models /micromedic/models
COPY index.js /micromedic

RUN npm init --yes
RUN npm install express morgan mysql mysql2 axios

CMD node index.js
