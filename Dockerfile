FROM python:3.7 as BUILD

WORKDIR /app

COPY requirements.txt ./

RUN pip install --install-option="--prefix=/install" -r requirements.txt

FROM python:3.7-alpine

WORKDIR /app

COPY --from=BUILD /install /usr/local
COPY . .

RUN python ./src/migrate.py db init
RUN python ./src/migrate.py db migrate
RUN python ./src/migrate.py db upgrade

EXPOSE 2009

CMD python run.py
