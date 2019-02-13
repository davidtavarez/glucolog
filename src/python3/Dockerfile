FROM python:3.7 as BUILD

WORKDIR /app

COPY requirements.txt ./

RUN pip install --install-option="--prefix=/install" -r requirements.txt

FROM python:3.7-alpine

WORKDIR /app

COPY --from=BUILD /install /usr/local
COPY . .

RUN python migrate.py db init
RUN python migrate.py db migrate
RUN python migrate.py db upgrade

EXPOSE 5000

CMD python run.py
