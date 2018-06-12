pipeline {
  agent {
    docker {
      image 'composer'
      args '-v /var/composer/cache:/var/composer/cache'
    }
  }
  stages {
    stage('Build') {
      steps {
        sh 'composer install'
      }
    }
    stage('run tests') {
      steps {
        sh 'composer test'
      }
    }
  }
}
