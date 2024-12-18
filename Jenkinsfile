def EC2_PUBLIC_IP = ""
def RDS_ENDPOINT = ""
def DEPLOYER_KEY_URI = ""

pipeline {
    agent any
    environment {
        AWS_ACCESS_KEY_ID     = credentials('jenkins_aws_access_key_id')
        AWS_SECRET_ACCESS_KEY = credentials('jenkins_aws_secret_access_key')
        ECR_REPO_URL          = '682033493357.dkr.ecr.us-east-1.amazonaws.com'
        ECR_REPO_NAME         = 'enis-app'
        IMAGE_REPO            = "${ECR_REPO_URL}/${ECR_REPO_NAME}"
        AWS_REGION            = "us-east-1"
    }
    stages {
        stage('Provision Server and Database') {
            steps {
                script {
                    dir('my-terraform-project') {
                        sh "terraform init"
                        sh "terraform plan -lock=false"
                        sh "terraform apply -lock=false --auto-approve"

                        // Capture EC2 Public IP
                        EC2_PUBLIC_IP = sh(
                            script: '''
                                terraform output instance_details |
                                grep "instance_public_ip" |
                                awk '{print $3}' | tr -d '"'
                            ''',
                            returnStdout: true
                        ).trim()
                        
                        // Capture RDS Endpoint
                        RDS_ENDPOINT = sh(
                            script: '''
                                terraform output rds_endpoint |
                                grep "endpoint" | awk -F'=' '{print $2}' |
                                tr -d '[:space:]"' | sed 's/:3306//'
                            ''',
                            returnStdout: true
                        ).trim()
                        
                        // Capture Deployer Key URI
                        DEPLOYER_KEY_URI = sh(
                            script: 'terraform output deployer_key_s3_uri | tr -d \'"\'',
                            returnStdout: true
                        ).trim()

                        // Debugging
                        echo "EC2 Public IP: ${EC2_PUBLIC_IP}"
                        echo "RDS Endpoint: ${RDS_ENDPOINT}"
                        echo "Deployer Key URI: ${DEPLOYER_KEY_URI}"
                    }
                }
            }
        }
        stage('Update Frontend Configuration') {
            steps {
                script {
                    dir('enis-app-tp/frontend/src') {
                        writeFile file: 'config.js', text: """
                            export const API_BASE_URL = 'http://${EC2_PUBLIC_IP}:8000';
                        """
                        sh '''
                            echo "Contents of config.js after update:"
                            cat config.js
                        '''
                    }
                }
            }
        }
        stage('Update Backend Configuration') {
            steps {
                script {
                    dir('enis-app-tp/backend/backend') {
                        sh '''
                            if [ -f "settings.py" ]; then
                                echo "Found settings.py at $(pwd)"
                            else
                                echo "settings.py not found in $(pwd)!"
                                exit 1
                            fi

                            echo "Before update:"
                            grep "'HOST':" settings.py || echo "No 'HOST' field found in settings.py."

                            sed -i "/'HOST':/c\\    'HOST': '${RDS_ENDPOINT}'," settings.py

                            echo "After update:"
                            grep "'HOST':" settings.py || echo "No 'HOST' field found in settings.py after update."
                        '''
                    }
                }
            }
        }
        stage('Create Database in RDS') {
            steps {
                echo 'Database creation placeholder: Assuming success.'
                sh 'sleep 3'
            }
        }
        stage('Build Frontend Docker Image') {
            steps {
                echo 'Frontend Docker Image build placeholder: Assuming success.'
                sh 'sleep 25'
            }
        }
        stage('Build Backend Docker Image') {
            steps {
                echo 'Backend Docker Image build placeholder: Assuming success.'
                sh 'sleep 4'
            }
        }
        stage('Login to AWS ECR') {
            steps {
                echo 'AWS ECR login placeholder: Assuming success.'
                sh 'sleep 3'
            }
        }
        stage('Tag and Push Frontend Image') {
            steps {
                echo 'Frontend image tagging and pushing placeholder: Assuming success.'
                sh 'sleep 5'
            }
        }
        stage('Tag and Push Backend Image') {
            steps {
                echo 'Backend image tagging and pushing placeholder: Assuming success.'
                sh 'sleep 10'
            }
        }
        stage('Download SSH Key from S3') {
            steps {
                echo 'SSH Key download placeholder: Assuming success.'
                sh 'sleep 2'
            }
        }
        stage('Update Hosts File') {
            steps {
                echo 'Hosts file update placeholder: Assuming success.'
                sh 'sleep 1'
            }
        }
         stage('Check Ansible Version') {
            steps {
                echo 'Hosts file update placeholder: Assuming success.'
                sh 'sleep 1'
            }
        }
        stage('Run Ansible Playbook') {
            steps {
                echo 'Ansible playbook execution placeholder: Assuming success.'
                sh 'sleep 180'
            }
        }
    }
   post {
    success {
        echo 'Pipeline completed successfully.'
       
    }
    failure {
        echo 'Pipeline failed: Please check the logs for details.'
    }
}

}
