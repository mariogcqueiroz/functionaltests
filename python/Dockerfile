FROM python:3.9-bullseye
RUN apt update
RUN apt-get install cargo libffi-dev -y

COPY requirements.txt /tmp/requirements.txt
RUN pip install -r /tmp/requirements.txt

COPY web /app

EXPOSE 8000
CMD ["python", "/app/index.py"]
