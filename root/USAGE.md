## A little Structure
First step you need to do is to to move `mu-plugins`, `.gitignore` and `.gitmodules` inside of `wp-content` folder (so basically two folders up).

After you did this, you need to run `git init` then `submodule update --init --recursive` to copy or update all dependencies needed.

### How to use Git?
My recommendation is to have the whole `wp-content` folder under version control. This way it's easier to replicate the whole set-up on multiple server. Obviously, you need to exclude `wp-content\uploads` in order to avoid huge repositories.

In order to separate theme by plugins, i also recommend to set `wp-content\plugins` as a separate repository (just run `git init` in that directory!) and include it as a submodule.

#### I don't use Git!
No problemo! You need to edit `.gitmodules` and clone each dependencies manually in their folder. For example:

```
[submodule "themes/{%= name %}/plugins/acf"]
  path = themes/{%= name %}/plugins/acf
  url = https://github.com/elliotcondon/acf.git
```

You need to clone ACF plugin into `themes/{%= name %}/plugins/acf`