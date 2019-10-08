# Unit Testing Workshop

## Getting Started

### Clone the Repository
```
git clone https://github.com/nomad145/workshop
```

### Start the Environment
```
docker-compose up -d
```

### Install Composer Dependencies
```
docker run --rm -it -v `pwd`:/app -w /app composer:latest install
```
