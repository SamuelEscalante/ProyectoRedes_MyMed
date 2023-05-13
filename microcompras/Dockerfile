FROM node

EXPOSE 3003

WORKDIR /microcompras

COPY controllers /microcompras/controllers
COPY models /microcompras/models
COPY index.js /microcompras

RUN npm init --yes
RUN npm install express morgan mysql mysql2 axios

CMD node index.js
                                     
