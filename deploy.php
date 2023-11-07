<?php

    namespace Deployer;

    require 'vendor/deployer/deployer/recipe/common.php';
    // require 'vendor/florianmoser/bedrock-deployer/recipe/bedrock_db.php';
    // require 'vendor/florianmoser/bedrock-deployer/recipe/bedrock_env.php';
    // require 'vendor/florianmoser/bedrock-deployer/recipe/bedrock_misc.php';
    // require 'vendor/florianmoser/bedrock-deployer/recipe/common.php';
    // require 'vendor/florianmoser/bedrock-deployer/recipe/filetransfer.php';
    // require 'recipes/cleanup.php';

// Configuration



//     set('writable_mode', 'chown');
    set('keep_releases', 3);

// Common Deployer config
    set( 'repository', 'git@github.com:cloudcreationsjess/updatedcloud.git' );
    set( 'shared_dirs', [
        'web/app/uploads',
        'web/app/plugins',
    ] );
    // Bedrock shared files
    set('shared_files', ['.env', 'web/.htaccess']);

// Bedrock DB and Sage config
    set( 'local_root', dirname( __FILE__ ) );

// Sage config
    set( 'theme_path', 'web/app/themes/sage' );

// File transfer config
    set( 'sync_dirs', [
        dirname( __FILE__ ) . '/web/app/uploads/' => '{{deploy_path}}/shared/web/app/uploads/',
        dirname( __FILE__ ) . '/web/app/plugins/' => '{{deploy_path}}/shared/web/app/plugins/',
    ] );

// With Sage 9 you will have to change the distribution files path to /dist
//set('sage/dist_path', '/dist');

// With Sage 9 you will have to change the build script command to "build:production"
//set('sage/build_command', 'build:production');

    // Hosts

    set( 'default_stage', 'production' );

    host( 'ssh.cloudcreations.ca' )
        ->set('stage',  'production' )
        ->set('user', 'u1140-q2nxlfcuckwc' )
        ->set('remote_user', 'u1140-q2nxlfcuckwc')
        ->set('port', '18765')
        ->set( 'deploy_path', '/home/u1564-sls8hozdtiyg/www/cloudcreations.ca' );

    // set( 'default_stage', 'staging' );
    //
    // host( '207.241.197.144' )
    //     ->set('stage',  'staging' )
    //     ->set('user', 'nginx' )
    //     ->set('remote_user', 'nginx')
    //     ->set('port', '2222')
    //     ->set( 'deploy_path', '/home/nginx/domains/avital.mtt-staging.com' );

    // set( 'default_stage', 'production' );

    // host( 'us216.siteground.us' )
    //     ->set('stage',  'production' )
    //     ->set('user', 'u1564-sls8hozdtiyg' )
    //     ->set('remote_user', 'u1564-sls8hozdtiyg')
    //     ->set('port', '18765')
    //     ->set( 'deploy_path', '/home/u1564-sls8hozdtiyg/www/fromsoiltosoul.ca' );

// Tasks

// Deployment flow
    desc( 'Deploy your project' );
    task( 'deploy', [
        'deploy:prepare',
        'deploy:clear_paths',
        // 'push:files-no-bak',
        // 'bedrock:vendors',
        // 'bedrock:env',
        'deploy:symlink',
        'deploy:unlock',
        'deploy:cleanup',
        'deploy:success',
    ] );

// [Optional] if deploy fails automatically unlock.
    after( 'deploy:failed', 'deploy:unlock' );
