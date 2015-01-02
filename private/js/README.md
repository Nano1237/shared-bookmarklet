all files from this folder will be loadet if this is correct:


%ORDER%_%REQUESTDOMAIN%_%REQUESTRESTRICTION%_*.js


where %ORDER% is a number in which order the file will be includet
and %REQUESTDOMAIN% is the domain where the bookmarklet is used 
and %REQUESTRESTRICTION% is the auth level of the user (logged in/anonymous)



one file for every (or all above a certain) must be the for every domain with the name "start"

example: google_2_start.js //This file will start all javascripts for users with an accesslevel above (or exacly) 2

The start file is very important. you can find the usage here