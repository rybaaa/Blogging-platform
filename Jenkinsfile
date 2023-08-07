
@Library('jenkins-build-helpers') _
setupEnvironment(['business_unit': 'corp'])

def createTestingEnvironment() {
    return setupContainers([
        [
            'name': 'main',
            'image': 'ike-docker-local.artifactory.internetbrands.com/corp/levelup-academy:arybak-testing-image',
            'imagePullPolicy': 'Always',
            'env': [
                ['name': 'DB_HOST',     'value': 'localhost'],
                ['name': 'PGPASSWORD',  'value': 'password'],
                ['name': 'DB_DATABASE', 'value': 'testing'],
                ['name': 'DB_USERNAME', 'value': 'sail'],
                ['name': 'DB_PASSWORD', 'value': 'password'],
                ['name': 'LOG_CHANNEL', 'value': 'single'],
                ['name': 'LOG_LEVEL',   'value': 'debug'],
            ],
        ],[
           'name': 'pgsql',
           'image': 'postgres:14',
           'env': [
                ['name': 'PGPASSWORD',        'value': 'password'],
                ['name': 'POSTGRES_DB',       'value': 'testing'],
                ['name': 'POSTGRES_USER',     'value': 'sail'],
                ['name': 'POSTGRES_PASSWORD', 'value': 'password'],
          ]
        ]
   ])
}

pipeline {
    agent none

    options {
        gitLabConnection('IB Gitlab')
    }

    stages {
        stage('Build pipeline testing image') {
            agent {
                kubernetes {
                    yaml dockerContainerImageBuildAndPushPodManifest()
                }
            }
            steps {
                container('builder') {
                    dockerContainerImageBuildAndPush([
                        'docker_repo_host': 'ike-docker-local.artifactory.internetbrands.com',
                        'docker_repo_credential_id': 'artifactory-ike',
                        'dockerfile': './pipeline/Dockerfile',
                        'docker_image_name': 'levelup-academy',
                        'docker_image_tag': 'arybak-testing-image' 
                    ])
                }
            }
        }

        stage('Run PHP tests') {
            when {
                expression { env.CHANGE_TARGET == null }
            }
            agent {
                kubernetes {
                    yaml createTestingEnvironment()
                }
            }
            post {
                success {
                    updateGitlabCommitStatus name: 'php-tests', state: 'success'
                }
                failure {
                    updateGitlabCommitStatus name: 'php-tests', state: 'failed'
                }
            }
            steps {
                container('main') {
                    sh 'echo "Branch $BRANCH_NAME going into $CHANGE_TARGET implemented by $CHANGE_AUTHOR"'

                    sh '''
                        composer install
                    '''

                    sh '''
                        APP_ENV=testing php artisan test --env=testing
                    '''
                }
            }
        }

        stage('Run MR Checks') {
            when {
                expression { env.CHANGE_TARGET != null }
            }
            agent any
            steps {
                script {
                    def invalidAuthors = []
                    def commitAuthors = sh(script: "git log --pretty=format:'%ae' ${CHANGE_TARGET}...${BRANCH_NAME} | sort -u",returnStdout: true).trim()

                    for (def author : commitAuthors.tokenize('\n')) {
                        if (!(author =~ /@internetbrands\.com$/)) {
                        invalidAuthors.add(author)
                        }
                    }

                    if (!invalidAuthors.isEmpty()) {
                        def invalidAuthorsList = invalidAuthors.join(', ')
                        error "Some MR commits have authors with emails not ending in '@internetbrands.com': ${invalidAuthorsList}"
                    } else {
                        echo "All commit authors have emails ending in '@internetbrands.com'."
                    }

                    //Check branch name

                    def validBranchPrefixes = ['build', 'ci', 'docs', 'feat', 'fix', 'perf', 'refactor', 'style', 'test']
                    def branchName = env.GIT_BRANCH.replaceAll("origin/", "").toLowerCase()
                    echo "${branchName} - my branch"
                    def isValidBranch = false

                    for (def prefix : validBranchPrefixes) {
                        if (branchName.startsWith(prefix)) {
                            isValidBranch = true
                            break
                        }
                    }

                    if (!isValidBranch) {
                        error "MR branch name does not start with a valid prefix: ${validBranchPrefixes.join(', ')}"
                    }
                }
            }
        }
    }
}