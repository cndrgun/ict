FROM postgres:10-bullseye
RUN localedef -i tr_TR -c -f UTF-8 -A /usr/share/locale/locale.alias tr_TR.UTF-8
ENV LANG tr_TR.utf8

RUN  echo "host all  all    0.0.0.0/0  md5" >> /var/lib/postgresql/data/pg_hba.conf
