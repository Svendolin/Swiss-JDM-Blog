***
#  🌸 JDM-BLOG Website🌸
---


![GitHub commit activity](https://img.shields.io/github/commit-activity/m/Svendolin/Swiss-JDM-Blog?style=for-the-badge) ![GitHub contributors](https://img.shields.io/github/contributors/svendolin/Swiss-JDM-Blog?style=for-the-badge) ![GitHub forks](https://img.shields.io/github/forks/Svendolin/Swiss-JDM-Blog?color=pink&style=for-the-badge) ![GitHub last commit](https://img.shields.io/github/last-commit/Svendolin/Swiss-JDM-Blog?style=for-the-badge) ![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/Svendolin/Swiss-JDM-Blog?color=yellow&style=for-the-badge)
***
This JDM Blogging Page should contain:

* Responsive layout using HTML/CSS and implemented design principles from the previous lessons
* A database that contains all relevant data (e.g. user data, articles, page content, etc.).
* Two seperate Layouts for unregistred as well as registred users
* A login form that registered users can use to log in. Once a user is logged in, they should be able to edit data in the database.
* A registration form that unregistered users can use to log in. This form should require at least four fields to be filled in and validated correctly (e.g. username, password,
E- mail address, last name, first name, etc.).


<span style="color:orange"> (Tasks and requirements are based on the SAE Institute Zurich)</span> 

<br />
<br />

***
## JDM-Blog (Explenation) 💬
***

The main purpose of the JDM blog is to network with other people who share the same hobby as me: They also own a car imported from Japan, maintain it, take it out for a drive and show their car at meetings. The blog scheme is meant to serve as a diary, a snapshot of past and future car meets. The site is intended to highlight upcoming car meets, capture past car meets for eternity via the blog feature, and list users who may present themselves in a summary table.

<br />
<br />

***
## Site explanation: ☑
***

HOME (index.php):

* Overview of events, news about the owner's vehicle and featured blogposts where the latest and most popular posts are loaded.

TELL YOUR STORY (tellyourstory.php):

* This page can only be accessed if the user has registered and has logged in afterwards. On this site user can write a blog post and have it displayed on the main page.

MEMBERBOARD (memberboard.php):

* As soon as the user has successfully registered, his or her profile is visibly displayed in a user gallery.

LOGIN and SIGNUP (login.php):

* Registration and login are carried out on this page.
* ``IMPORTANT: (Password / Username / Email of the regstered users are stored at .gitignore)``

ADMIN LOGIN (footer):

* Admin functions are carried out on this page.
* ``IMPORTANT: (Password / Username / Email of the regstered users are stored at .gitignore)``

<br />
<br />



***
## Database Design (Explenation) 💬
***

Each user should provide the following information via registration form in order to register:
- Surename and Familyname
- Username (Shown in Blogposts, as well as publishing date)
- Vehicle (Car Brand, Model, Year)
- Image of the vehicle
- Place of residence (Canton only)
- Email address 
- Password
- Password Repeat

(Users can write and edit blogs while they are registrated and logged in)

(Users can watch blogs while they aren't registrated and also logged out)

(Admin should be able to edit and delete blog posts)

(Admin should be able delete users)

<br />
<br />

***
## PHP-Concept (Explenation) 💬
***


|Folder   |Content  |
| ---   | ---   |
|admin| Admin area (index.php) to delete and modify user profiles (user.php) and blogposts (blogposts.php) |
|blogpost_images|Local storage of blogpost images (temporary folder)|
|favicon|All favicon symbols for each devices|
|images|Image folder to storage all the used images for this project|
|includes|All inc files concerning included header and footer (html), database config (config.php) and mysql connections(mysql-connect.php) as well as functions (functions.inc.php) for the login and signup|
|passwordstuff| Passwords and usernames to login with the matching profile|
|theme|Includes the css folder with all the styles, fonts folder with additional fonts and javascript for the logical part|
|user_images|Local storage of user images (temporary folder)|
|index.php| Main page |
|login.php|Sign in and Sign up area |
|logout.php| Section to destroy the logged in session |
|memberboard.php| Displayed User-Gallery|
|post.php| Full review of a selected blogpost matching with their ID|
|swiss_jdm_blog.sql| Exported Database |
|tellyourstory.php| Area where users can write blogposts |


<br />
<br />

***
## License
***
[MIT](https://choosealicense.com/licenses/mit/) 🟢✔

<br />
<br />

***

## Technologies ✅
***
 Please make sure to update the CDNJS links from time to time
* [CDNJS](https://cdnjs.com/) : Used to link at JQuery, Fontawesome, GSAP
* [GOOGLE FONTS](https://cdnjs.com/) : Used for my fonts

<br />
<br />

***
## FAQs ✅
***
3 Questions have been asked, 3 answers have been given, 3 changes have additionally been made.

| Question: | Anwer: | corrected? |
|:--------------|:-------------:|:--------------:|
| Does ``for=""`` from label should match with ``id=""`` from input? | YES | YES |
| Do I always have to write an input field WITH a label? | YES (you can leave it empty too if you wish) | YES |
| Is: ``name=""`` of an input field is used for the isset()-Affenschwanz-Durchlauf? | YES | YES |