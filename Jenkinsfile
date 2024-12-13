def EC2_PUBLIC_IP = "" // Set EC2 Public IP here if needed
def RDS_ENDPOINT = ""  // Set RDS Endpoint here
def DEPLOYER_KEY_URI = "" // Set the URI for the deployer's SSH key if needed

pipeline {
    agent any
    environment {
        AWS_ACCESS_KEY_ID     = credentials('jenkins_aws_access_key_id')
        AWS_SECRET_ACCESS_KEY = credentials('jenkins_aws_secret_access_key')
        ECR_REPO_URL          = '682033493357.dkr.ecr.us-east-1.amazonaws.com'
        ECR_REPO_NAME         = 'enis-app'
        IMAGE_REPO            = "${ECR_REPO_URL}/${ECR_REPO_NAME}"
        AWS_REGION            = "us-east-1"
        RDS_DB_USER           = 'dbuser' // Add as an environment variable if possible
        RDS_DB_PASSWORD       = credentials('db_password') // Handle sensitive information securely
    }
    stages {
        stage('Create Database in RDS') {
            steps {
                script {
                    // Ensure RDS_ENDPOINT is set before proceeding
                    if (RDS_ENDPOINT == "") {
                        error "Error: RDS_ENDPOINT is empty"
                    }

                    // Create the database in RDS using MySQL
                    sh """
                        docker run --rm mysql:latest \
                            mysql -h ${RDS_ENDPOINT} -P 3306 -u ${RDS_DB_USER} -p${RDS_DB_PASSWORD} -e "CREATE DATABASE IF NOT EXISTS enis_tp;"
                        
                        docker run --rm mysql:latest \
                            mysql -h ${RDS_ENDPOINT} -P 3306 -u ${RDS_DB_USER} -p${RDS_DB_PASSWORD} -e "SHOW DATABASES;"
                    """
                }
            }
        }
        
        stage('Build Frontend Docker Image') {
            steps {
                dir('enis-app-tp/frontend') {
                    script {
                        echo 'Building Frontend Docker Image...'
                        def frontendImage = docker.build('frontend-app')
                        echo "Built Image: ${frontendImage.id}"
                    }
                }
            }
        }

        stage('Build Backend Docker Image') {
            steps {
                dir('enis-app-tp/backend') {
                    script {
                        echo 'Building Backend Docker Image...'
                        def backendImage = docker.build('backend-app')
                        echo "Built Image: ${backendImage.id}"
                    }
                }
            }
        }

        stage('Login to AWS ECR') {
            steps {
                script {
                    echo 'Logging into AWS ECR...'
                    sh """
                        aws ecr get-login-password --region ${AWS_REGION} | docker login --username AWS --password-stdin ${ECR_REPO_URL}
                    """
                }
            }
        }

        stage('Tag and Push Frontend Image') {
            steps {
                script {
                    echo 'Tagging and pushing Frontend Image...'
                    sh "docker tag frontend-app:latest ${IMAGE_REPO}-frontend"
                    sh "docker push ${IMAGE_REPO}-frontend"
                }
            }
        }

        stage('Tag and Push Backend Image') {
            steps {
                script {
                    echo 'Tagging and pushing Backend Image...'
                    sh "docker tag backend-app:latest ${IMAGE_REPO}-backend"
                    sh "docker push ${IMAGE_REPO}-backend"
                }
            }
        }
    }
}
