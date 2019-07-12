FROM postgres:9-alpine

COPY run.sh /bin/

RUN chmod +x /bin/run.sh

ENTRYPOINT ["run.sh"]
CMD ["postgres"]
