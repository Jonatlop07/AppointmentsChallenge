FROM python:3.10-slim

# Set the working directory inside the container
WORKDIR /app

# Copy the requirements file to the container
COPY requirements.txt .

# Install any dependencies specified in requirements.txt
RUN pip install --no-cache-dir -r requirements.txt

# Copy the rest of the application files to the container
COPY appointments_etl.py .

# Set the default command to execute the script
CMD ["python", "appointments_etl.py"]