all_changes="$(git diff --name-only origin/master ... $1)"
echo "$all_changes" |  tr "\n" "," | sed 's/,$/ /' | tr " " "\n"
