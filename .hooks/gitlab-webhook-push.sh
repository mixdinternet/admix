#!/bin/sh

## GitLab push hook update script

# The output of this script is logged by PHP, so any unnecessary output should
# be discarded. To enable logging of any output the cd command produces, make
# the command look like this:
#
#     cd ..
#
cd .. > /dev/null &

# Pulls currently configured upstream branch. To configure the upstream branch,
# use the following command:
#
#     git branch --set-upstream local-branch origin/remote-branch
#
# where:
#   local-branch   the name of your local branch
#   origin         the name of the upstream remote
#   remote-branch  the name of the upstream branch
#
# The remote upstream branch should only be configured once, unless the remote
# name changes
#

git reset --hard HEAD
git pull