## Source
This is based from [Remchi/dotfiles](https://github.com/Remchi/dotfiles).

## Installation

* Clone repository.

```
cd ~
git clone git@github.com:jetoneza/cnfgx.git .dotfiles
cd .dotfiles
git filter-branch --prune-empty --subdirectory-filter dotfiles/ HEAD
```

### Vim Setup

* Create symbolic links to vim files.

```
ln -s .dotfiles/vim .vim
ln -s .dotfiles/vimrc .vimrc
```

#### Plugins

Install [Vundle](https://github.com/VundleVim/Vundle.vim) and install plugins.

#### Fonts

To enable airline fonts, install [Powerline Fonts](https://github.com/powerline/fonts).

### ZSH Setup

* Install [oh-my-zsh](https://github.com/robbyrussell/oh-my-zsh).
* Add the [jetoneza](https://github.com/jetoneza/cnfgx/tree/master/dotfiles/oh-my-zsh) theme to `~/.oh-my-zsh/themes`.
* Create symbolic link to zshrc.

```
ln -s .dotfiles/zshrc .zshrc
```
