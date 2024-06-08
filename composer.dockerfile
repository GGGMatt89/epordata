FROM composer:2

ENV COMPOSERUSER=epordata
ENV COMPOSERGROUP=epordata

RUN adduser -g ${COMPOSERGROUP} -s /bin/sh -D ${COMPOSERUSER}
