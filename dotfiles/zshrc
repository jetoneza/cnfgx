# -----------------------------------
#  ZSH Configuration
# -----------------------------------

# Path to your oh-my-zsh installation.
export ZSH=$HOME/.oh-my-zsh

# Set name of the theme to load.
ZSH_THEME="jetoneza"

# Uncomment the following line to disable bi-weekly auto-update checks.
DISABLE_AUTO_UPDATE="true"

# Which plugins would you like to load? (plugins can be found in ~/.oh-my-zsh/plugins/*)
# Custom plugins may be added to ~/.oh-my-zsh/custom/plugins/
# Example format: plugins=(rails git textmate ruby lighthouse)
# Add wisely, as too many plugins slow down shell startup.
plugins=(git)

# User configuration
# export MANPATH="/usr/local/man:$MANPATH"

source $ZSH/oh-my-zsh.sh

# You may need to manually set your language environment
# export LANG=en_US.UTF-8

# Preferred editor for local and remote sessions
# if [[ -n $SSH_CONNECTION ]]; then
#   export EDITOR='vim'
# else
#   export EDITOR='mvim'
# fi

# ssh
# export SSH_KEY_PATH="~/.ssh/dsa_id"

# ------------------------------------
# EXPORT PATHS
# ------------------------------------

export PATH=/usr/local/bin:$PATH
export PATH=/usr/local/sbin:$PATH
export PATH=/Users/jeetkunedo/Repos/arcanist/bin:$PATH
export PATH=/Users/jeetkunedo/.composer/vendor/bin:$PATH
export PATH="/Library/Python/2.7/site-packages:${PATH}"

# Virtualenv/VirtualenvWrapper
# source /usr/local/bin/virtualenvwrapper.sh

# export VIRTUALENVWRAPPER_PYTHON=/usr/local/bin/python3
# source /usr/local/bin/virtualenvwrapper.sh

# ------------------------------------------
# CUSTOM ALIASES
# ------------------------------------------

alias root="cd ~/"

# Edit .bash_profile
alias ebash="sudo vim ~/.zshrc"
# Save changes in .bash_profile
alias sbash=". ~/.zshrc"

# Git
alias gits="git status"
alias gitf="git fetch origin"

gitrebase() { git rebase origin/$1; }
alias gitr=gitrebase

gitpush() { git push origin $1; }
alias gitp=gitpush

gitshort() {
  gits;
  gitf;
  gitr master;
}
alias gitx=gitshort

# Arcanist
arcclose() { arc close-revision $1; }
alias acl=arcclose
alias amd="arc amend"
alias diff="arc diff"

# Mysql
alias sql="mysql.server start"
alias sqlog="mysql -u root -p"

# Open programs
openprogs() {
  open -a Google\ Chrome;
  open "https://news.ycombinator.com";
  open "https://gmail.com";
  open -a Slack;
  open -a Telegram;
}
alias abri=openprogs

# Testing in yii
yisingletest() {
  cd workspace/tests/phpunit; sudo ../../vendor/bin/phpunit unit/Sakanade/$1;
}
alias ystest=yisingletest

# Daemons shortcuts
taskdaemon() {
  cd workspace/daemons; php run.php --class=TaskDaemon --env=dev --config=daemons/dev --tubes=common,firstParser,secondParser,thirdParser;
}

alias taskdmn=taskdaemon

taildaemon() {
  cd workspace/shared-data; tail -f runtime/task-daemon.log;
}

alias taildmn=taildaemon

# SSH
alias sshkey="pbcopy < ~/.ssh/id_rsa.pub"

# Sandbox
sandbox() {
  cd ~/sandbox/$1/$2/$3
}

alias sbox=sandbox

# Sublime
sublime() {
  open $1 -a Sublime\ Text;
}
alias sbl=sublime

# ls
alias lsf="ls -GHf"
alias ls="ls -GFh"
alias ll="ls -l"
alias la="ls -la"

# HELP DOCS PARA MI
# Colors constants
BLACK=$(tput setaf 0)
RED=$(tput setaf 1)
GREEN=$(tput setaf 2)
YELLOW=$(tput setaf 3)
LIME_YELLOW=$(tput setaf 190)
POWDER_BLUE=$(tput setaf 153)
BLUE=$(tput setaf 4)
MAGENTA=$(tput setaf 5)
CYAN=$(tput setaf 6)
NORMAL=$(tput sgr0)


helpusall() {
  printf "\n";
  printf "d888888P  .d888888  888888ba   .d888888  888888ba   .88888.  \n"
  printf "   88    d8'    88  88    '8b d8'    88  88    '8b d8'   '88 \n";
  printf "   88    88aaaaa88  88aaaa8P' 88aaaaa88  88     88 88        \n";
  printf "   88    88     88  88   '8b. 88     88  88     88 88   YP88 \n";
  printf "   88    88     88  88    .88 88     88  88     88 Y8.   .88 \n";
  printf "   dP    88     88  88888888P 88     88  dP     dP  '88888'  \n";
  printf "${CYAN}Tabang ${NORMAL}version ${GREEN}1.7 ${NORMAL}docs\n\n";
  printf "${GREEN}Available commands:\n";
  printf "${BLUE}  root\t\t\t\t${NORMAL}adto sa root directory\n";
  printf "${BLUE}  webreq\t\t\t${NORMAL}listahan sa mga kinahanglan sa web development\n";
  printf "\n${GREEN}Git Commands:\n";
  printf "${BLUE}  gits\t\t\t\t${NORMAL}git status\n";
  printf "${BLUE}  gitf\t\t\t\t${NORMAL}git fetch origin\n";
  printf "${BLUE}  gitr [branch]\t\t\t${NORMAL}git rebase origin/<branch>\n";
  printf "${BLUE}  gitp [branch]\t\t\t${NORMAL}git push origin/<branch>\n";
  printf "\n${GREEN}Yii related web development:\n";
  printf "${BLUE}  ystest [directory]\t\t${NORMAL}single unit test sa yii\n";
  printf "${BLUE}  taskdmn\t\t\t${NORMAL}sugdan ang task daemon\n";
  printf "${BLUE}  taildmn\t\t\t${NORMAL}i-tail ang task daemon\n";
  printf "\n${GREEN}Arcanist:\n";
  printf "${BLUE}  amd\t\t\t\t${NORMAL}arc amend\n";
  printf "${BLUE}  diff\t\t\t\t${NORMAL}arc diff\n";
  printf "${BLUE}  acl [revision]\t\t${NORMAL}arc close-revision <revision>\n";
  printf "\n${GREEN}MySQL:\n";
  printf "${BLUE}  sql\t\t\t\t${NORMAL}start mysql\n";
  printf "${BLUE}  sqlog\t\t\t\t${NORMAL}login to mysql\n";
  printf "\n${GREEN}Auto apps na pre:\n";
  printf "${BLUE}  abri\t\t\t\t${NORMAL}abrihan mga kinahanglan nga apps, diretso na\n";
  printf "\n${GREEN}Bash profile:\n";
  printf "${BLUE}  ebash\t\t\t\t${NORMAL}edit .bash_profile\n";
  printf "${BLUE}  sbash\t\t\t\t${NORMAL}save changes sa .bash_profile\n";
  printf "\n${GREEN}SSH:\n";
  printf "${BLUE}  sshkey\t\t\t${NORMAL}copy ssh key to clipboard${GREEN} NEW!${NORMAL}\n";
  printf "\nType lang ug ${RED}tabang${NORMAL} kung naka limot naka! Type ${RED}bag-o${NORMAL} sa mga nadungag sa version 1.7!\n\n";
}
alias tabang=helpusall

newupdate() {
  printf "\n${GREEN}NEW! ${NORMAL}Mga bag-o sa ${CYAN}Tabang Docs ${NORMAL}version ${GREEN}1.7${NORMAL}\n\n";
  printf " - 1.7 Copy ssh to clipboard! ${BLUE} sshkey ${NORMAL}command!\n";
  printf "\nType lang ug ${RED}tabang${NORMAL} kung naka limot naka! Type ${RED}bag-o${NORMAL} sa mga nadungag sa version 1.7!\n\n";
}
alias bag-o=newupdate
