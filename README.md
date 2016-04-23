# FuseCodingBootcamp

The purpose of this project is to teach developers some of the basics of devops and show them some of the technologies that are used to support the development lifecycle.  The technologies that will be covered include Docker, Amazon Web Services, Jenkins and Chef. 


# First Thing:  Name for the team


### Docker
* Information About Docker
* What is docker?
* Where can I run docker?
* Where does Fuse use docker?
* Why should I/Can I use docker?
* It works on my machine
* Very easy to change versions/configurations
* Portable
* You don’t need in depth knowledge of the server where the app will be deployed

# Installing Docker and Virtualbox
  * https://www.virtualbox.org/wiki/Downloads
  * https://docs.docker.com/engine/installation/

  # Installing git
  * https://git-scm.com/downloads
  
## Docker on Windows and OSX
  * https://www.docker.com/products/docker-toolbox
* Creating the docker machine after installing docker-toolbox
```docker-machine create -d virtualbox --virtualbox-memory=4096 --virtualbox-cpu-count=2 --virtualbox-disk-size=50000 dev```
* Docker on Linux


## Docker Basics
* Finding docker images to run
    * Docker Hub
    * Google/Bing/Yahoo
* Pulling docker images
* Building docker images from a dockerfile
* Docker tags
* Running docker images
* Exposing ports
* Mapping local directories to container paths
* Environmental variables
* Getting container status
* Looking at container logs
* Logging into the container
* Accessing websites/services running in the container
* Killing running containers
* Listing images on a docker host

# BREAK

## Let’s run our first docker container
* ```docker run -d -p 3000 asakaguchi/docker-nodejs-hello-world```
* ```docker ps```

## Running the cloud9 development environment and persisting data

* docker run -it -d -p 80:80 -v //c/Users/%USERNAME%/workspace/:/workspace/ kdelfour/cloud9-docker

* docker run -it -d -p 80:80 -v /Users/USERNAME/Documents/workspace/:/workspace/ kdelfour/cloud9-docker


# Creating your own docker container (lets get creative.  It's up to you what we create)
* Dokerfile basics
* From
* Maintainer
* Running commands
* Adding files
* Exposing ports
* Working directory
* Environmental Variables
* CMD function
* Advanced dockerfile configurations
* What if I need to change a value in a configuration file when starting the application?
* Building the container locally

# BREAK

## Docker Compose
* Docker compose example
* Docker compose for a development environment
* Docker compose for a Wordpress test environment
* Docker compose for a Minecraft server environment

## Amazon Web Services (AWS)
* Amazon Services Examples
* EC2
* S3
* EC2 container Service
* Lambda
* Login with Amazon
* How does Fuse use Amazon?
* Student use of Amazon http://aws.amazon.com/education/awseducate/
* AWS Free Tier Usage https://aws.amazon.com/free/faqs/

# Standing up your own docker registry on AWS
* http://codepen.io/tsabat/post/s3-backed-docker-private-registry-on-aws

# Jenkins
* What is Jenkins
* How is Jenkins Used

# Chef and Vagrant for provisioning machines
* What is Chef?
	* https://downloads.chef.io/chef-dk/
* What is Vagrant?
	* https://www.vagrantup.com/downloads.html
* Chef server vs Chef solo
* Chef and Vagrant Example
	
	


