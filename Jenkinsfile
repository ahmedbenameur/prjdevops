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
      
        stage('Update Backend Configuration') {
            steps {
                script {
                    dir('enis-app-tp/backend/backend') {
                        // Check if `settings.py` exists and update the HOST in the DATABASES section
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
    }
}
