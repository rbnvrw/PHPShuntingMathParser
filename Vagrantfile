Vagrant.configure(2) do |config|
  config.vm.box = "ubuntu/trusty64"
  config.vm.provision :shell, path: "vagrant/vagrant.sh"
  config.vm.provision "shell", path: "vagrant/bootstrap.sh", privileged: false
  config.vm.network "forwarded_port", guest: 80, host: 8080, auto_correct: true
  config.vm.provider "virtualbox" do |vb|
    vb.gui = false
    vb.memory = "512"
  end
  config.vm.synced_folder ".", "/vagrant", :mount_options => ["dmode=777","fmode=766"]
  config.vm.provision "shell", path: "vagrant/vagrant_start.sh", run: "always"
  config.vm.provision "shell", path: "vagrant/vagrant_user.sh", privileged: false, run: "always"
end
