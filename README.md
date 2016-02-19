#Hacker Heaven
A competition for TechOlympics
@authors: Amy Huang, Matt Busch, John Simerlink

mysql root @ localhost password is getfiredup2012


structure
-upon clicking submit on a question, a post request is sent to to answers.php with a hidden input element called question number or something obfuscated: arstdhne  . .. this mean each question has that hidden element
-server receives the request, and gets the guessed password and question number. checks the password for that question number. if correct, it returns the HTML for the next question and the ajaxFormsuccesscallback parses a starting string knowing that its html and if so, $('#message').html(parsedResult). otherwise server replies 'not correct', and the client parsing that message alerts 'not correct'