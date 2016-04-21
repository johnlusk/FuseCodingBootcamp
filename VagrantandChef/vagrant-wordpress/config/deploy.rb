# config valid only for Capistrano 3.1
lock '3.2.1'

set :application, 'example.com'
set :repo_url, 'https://github.com/Design-Collective/wordpress-cap-chef.git'


#set :ssh_options, {
#  forward_agent: true,
#  user: 'deploy'
#}

# Default branch is :master
# ask :branch, proc { `git rev-parse --abbrev-ref HEAD`.chomp }

# Default deploy_to directory is /var/www/my_app
set :deploy_to, '/srv/git'
set :document_root, '/srv/www'
set :deploy_via, :copy

# Default value for :scm is :git
# set :scm, :git

# Default value for :format is :pretty
# set :format, :pretty

# Default value for :log_level is :debug
# set :log_level, :debug

set :git_strategy, SubmoduleStrategy

set :log_level, :info

#set :use_sudo, false
set :use_sudo, true
set :user, "www-data"
set :group, "www-data"

# desc "Change group to www-data"
#task :chown_to_www-data, :roles => [ :app, :db, :web ] do
#   sudo "chown -R #{user}:www-data #{deploy_to}"
#end

# Default value for :pty is false
# set :pty, true

# Default value for linked_dirs is []
# set :linked_dirs, %w{bin log tmp/pids tmp/cache tmp/sockets vendor/bundle public/system}

set :linked_dirs, %w{wp-content/plugins}

# set :linked_files, %w{wp-config.php}
#set :linked_dirs, %w{wp-content/plugins}

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for keep_releases is 5
set :keep_releases, 5

namespace :deploy do

  desc "Create wordpress symlinks"
  task :symlink_folders_wordpress do
    on roles(:web) do
        #execute "cd '/srv/www/wp-content'"
        execute "if [[ ! -h #{fetch(:document_root)}/wp-content/themes ]]; then mv #{fetch(:document_root)}/wp-content/themes #{fetch(:document_root)}/wp-content/themes_old && ln -nsf #{fetch(:deploy_to)}/current/wp-content/themes #{fetch(:document_root)}/wp-content/themes; fi"
    end
  end

  after :starting, :symlink_folders_wordpress


  desc 'Restart application'
  task :restart do
    on roles(:app), in: :sequence, wait: 5 do
      # Your restart mechanism here, for example:
      # execute :touch, release_path.join('tmp/restart.txt')
    end
  end

  after :publishing, :restart

  after :restart, :clear_cache do
    on roles(:web), in: :groups, limit: 3, wait: 10 do
      # Here we can do anything such as:
      # within release_path do
      #   execute :rake, 'cache:clear'
      # end
    end
  end

  after :finishing, 'deploy:cleanup'

end

desc "Check that we can access everything"
task :check_write_permissions do
  on roles(:all) do |host|
    if test("[ -w #{fetch(:deploy_to)} ]")
      info "#{fetch(:deploy_to)} is writable on #{host}"
    else
      error "#{fetch(:deploy_to)} is not writable on #{host}"
    end
  end
end
