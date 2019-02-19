FROM python:3.7 as BUILD

WORKDIR /app

COPY requirements.txt ./

RUN pip install --install-option="--prefix=/install" -r requirements.txt

FROM python:3.7-alpine

WORKDIR /app

COPY --from=BUILD /install /usr/local
COPY . .

EXPOSE 2009

RUN python ./src/migrate.py db init
RUN python ./src/migrate.py db migrate
RUN python ./src/migrate.py db upgrade

CMD python ./src/run.py
