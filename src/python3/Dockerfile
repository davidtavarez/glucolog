FROM python:3.7

WORKDIR /app

COPY requirements.txt ./

RUN pip install -r requirements.txt

COPY . .

RUN python migrate.py db init
RUN python migrate.py db migrate
RUN python migrate.py db upgrade

EXPOSE 5000

CMD python run.py
