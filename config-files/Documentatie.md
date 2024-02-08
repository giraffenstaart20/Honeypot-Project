# **Group 14 Honeypot server**

# **Logs** 

We have logs on every page, this is because we need to know what the user is doing on wich page.

The easiest way to do this in php is with the trigger\_error function. 

For example the following piece of code in the avatar.php:

trigger\_error("username: " . $username . ' filename: ' . $new\_file\_name . ' filetype: ' . $fileExtension . 'filesize: ' . $file\_size, E\_USER\_WARNING);

So what does this code exactly do? The first part **“username”** is the text that will appear on our dashboard. The $username is the actual username that is logged in at that moment. So this trigger\_error function will log all this data on the dashboard whenever a user is inputting a wrong file.

Of course we have logging on every user input. But we won’t explain all the lines of code because it is very similar.

## **How do these logs look on the dashboard?**

![](Aspose.Words.62833574-0d5a-4c69-b569-e87b8f2d7944.001.png)

Here we can see the user and what they tried to upload. Now we would be able to ignore this input or we can deactivate the user in the admin panel.

But of course we don’t want to search for wrong input in these messages. We want to see it in a graph. The first dashboard page that we have is a traffic page.

On the graph we can see the traffic on the admin page. Of course we have a lot more graphs then just this admin graph.

![](Aspose.Words.62833574-0d5a-4c69-b569-e87b8f2d7944.002.png)

Of course we don’t only want to see traffic, we need to see the malicious errors in graphs to.

As an admin we are able to see this input by clicking on the graph and looking for malicious input. This is auto detected too. 

# **Security changes**

Because we saw all kinds of exploits on our logging system we had to check if these actually worked. And some of them did, so we implemented some more code to protect against these attacks.

**XSS**

There were some permissions problems, this wasn’t really fixed with code. This had more to do with the server permissions. 


**SQLi**

Sqli on the register and login page. This was a very important exploit to fix. But it was relatively easy. Php has some anti sqli functions as standard. Here is some example code:

$username = mysqli\_real\_escape\_string($connRegister, $username);

$password = mysqli\_real\_escape\_string($connRegister, $password);

So this function checks the db connection and the POST in the username and password field. It automatically detects sqli. 


**Reflected xss**

After a while we found out about some new users in our database. The new usernames were malicious. ![](Aspose.Words.62833574-0d5a-4c69-b569-e87b8f2d7944.003.png)

We had to fix this xss attack, after some research we found out that php already has some build in xss protection. So we just implemented these functions. Here some example code again:

$username = htmlspecialchars($username, ENT\_QUOTES, 'UTF-8');

$username = strip\_tags($username);

The first function htmlspecialchars is to remove any weird characters and only accept UTF-8. The second function is used to remove tags from the input. For example ‘<’ and ‘>’.

**Avatar Upload**

Uploading an avatar was never something that was getting exploited but we considered implementing some protection anyways. Users are only able to upload a file that has to be a certain size. The extension can only be a jpg, png as well.

# **Lecturer attacks and special attacks**
## **likely teacher driven attack Thu Nov 24 15:15:49**
Attempt 1: registering without password try on register with koenk user

Attempt2: trying XSS: \<script\>alert(1)\</script\> on xss.php

Attempt3: trying SQLI: ' or 1=1; on sqli.php

Attempt4: trying stored XSS by registering “\</span\>\<script\>alert(document.domain)\</script\>” as username.

Attempt5: trying stored xss attack through avatar upload of malicious xss.png file. -> severity


<br>

## **Likely teacher driven attack 2 Fri Nov 25 13:19:56**
Attempt1: trying to login with old user, but forgot password

Attempt2:  Xss attempt using “\<h1 onload=alert(1)\>fds\</h1\>” as payload

Attempt3: XSS attempt using “\<script\>alert(1)\</script\>” as payload.


<br>

## **Third (true) teacher driven attack vrijdag 6 dec 07:30:**

Attempt 1: trying to login with get request and parameter user=user

Attempt 2:  trying to login with get request and parameter user=user2

Attempt 3: trying to log in with get request and parameter userid=1

Attempt 4: trying to log in with get request and parameter user=admin&admin=true

Clear indicator: k0en_k_was_here as browser   IP: 10.202.106.23

<br>

## Most common attacks:
Stored XSS attempts on register and login. like username: “\</span\>\<script\>alert(document.domain)\</script\>”

<br>

## Special attacks:
attempt of reverse shell upload by user test on Mon Nov 28 10:53:05

attempt of using insecure username and password -> admin 123 as attempt to log in on Mon Nov 28 11:05:05

Attempt timo -> successful attack of escaping the uploads folder.

# **Overview of challenges** 

**Challenge 1:**

The first challenge is a xss challenge. Users are able to place a personal comment on the site. This comment will be displayed too. The way to solve this challenge is upload any xss payload, the user will know if it worked when the xss appears on the site. There isn’t any protection on this exercise, the exploits effectively work. But an attacker won’t be able to harm the site because this whole exercise is set up on a fake database.

**Challenge 2:**

The second challenge is a sqli attack. A user is able to look up other users in the database. The site will respond with a message if the user exists or not. The way to solve this exercise is by inputting the correct sqli payload. Then the attacker will see some dummy data and think he’s in.

**Challenge 3:**

This third challenge is an IDOR attack. The user is able to contact a moderator. This is done by selecting the moderator and then the contact info will be displayed. The way to solve this challenge is changing the link from moderator to admin. This will display some fake dummy data.

**Challenge 4:**

This challenge is all about uploading a malicious file. Users are able to upload a txt file with complaints. This will be uploaded to the database. The way to solve this challenge is injecting an exe file instead of a txt file. Uploading an exe file won’t give an error. If this exe is filled with malicious code it wouldn’t matter. Because we don’t actually upload the file to the database. If somehow an attacker is able to upload a malicious file to the database. It wouldn’t matter because it is uploaded to a fake database anyway. 

**Challenge 5:**

This is a challenge where attackers have to search for a secret file. This file contains dummy data about the server. 






# **Pentesting on others**

**Group 3:**

**Broken authentication: Able to change the cookie id to log in as a different user.**

**Able to uploads malicious scripts in avatar.**

<br>

**Challenge 1:**

\<script>alert('1')\</script>

**Challenge 2:**

\<h1>\<IFRAME SRC="javascript:alert('XSS');">\</IFRAME>">123\<h1>

**Challenge 3:**

\<canvas> alert('1')</\</canvas>

**Challenge 4:**

Change link in anchor tag and put onlcick event on it.

**Challenge 5:**

Change alt title and src of image

<br>

**Group 4:**

**Challenge 1:**

breach{1\_am\_a\_t3a\_p0t}

look in the html.

**Challenge 3:**

Use burpsuite to automate the xss payloads from github.

**Challenge 5:**

Change the link in the form to solve. (IDOR)

<br>

**group 10:**

**Challenge 1:**

“Tzen ekik eh!”

found in html with inspect

**Challenge 2:**

\<img src=”#” onerror=alert(1)>

**Challenge 5:**

<https://group10web.hp.ti.howest.be/challenges/extrafiles/supersecretpassword.txt>

<br>

**group16**

**Challenge 2:**

admin, admin

**Challenge 3:**

change link, log in with admin 

