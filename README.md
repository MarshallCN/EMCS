Expiration Management & Cooking Suggestion (EMCS) is a web-based prototype system, which helps you track food expiration date, create shopping list and give suggestions you on cooking. It was designed to aim at reducing household food waste. You can use web browser to access to the service through the following URL: https://marshal1.tech (deprecated)
# Dependencies
![jq](https://badgen.net/badge/jQuery/v3.2.1/?color=yellow)
![vue](https://badgen.net/badge/Vue.js/v2.5.13/?color=yellow)
![chart](https://badgen.net/badge/Chart.js/v2.5.0/?color=yellow)
![fa](https://badgen.net/badge/FontAwesome.css/v4.7.0/?color=blue)
![bootstrap](https://badgen.net/badge/Bootstrap/v3.3.7/?color=pink)
![phpmailer](https://badgen.net/badge/PHPMailer/v5.5/?color=green)
![Attrigger](https://badgen.net/badge/Attrigger/v0.1.1/?color=green)
![gcm](https://badgen.net/badge/GoogleCloudMessaging/deprecated/?color=red)
# Main Functions
## Sign up & Login
![login1](/screenshots/pc/login.png) 
![login2](https://github.com/MarshallCN/EMCS/blob/master/screenshots/pc/login%20new%20user.png) 
## Food Storage page
In left navigation bar, you can change the current showing place. There are four places that you can store your food: “Refrigerator”, “Freezing Chamber”, “Pantry” and “Other”. And on the top tabs, you can choose to view food in blocks or table.
![food1](https://github.com/MarshallCN/EMCS/blob/master/screenshots/pc/all%20food%20block.png) 
![food2](https://github.com/MarshallCN/EMCS/blob/master/screenshots/pc/all%20food%20table.png) 
### Add food to storage
While you inputting your food name, the system will use ajax to find the most similar food category automatically. You can also click the category selection to choose the right one. If you type “– “after your food name, it will become “uncategorized”. Meanwhile, a food storage shelf life table will be showed on the right of screen, which give you advice on food storage. 
![food3](https://github.com/MarshallCN/EMCS/blob/master/screenshots/pc/add%20food%201.png) 
![food4](https://github.com/MarshallCN/EMCS/blob/master/screenshots/pc/add%20food%202.png) 
![food5](https://github.com/MarshallCN/EMCS/blob/master/screenshots/pc/add%20food%203.png) 
### Edit or Delete food in storage
![food6](https://github.com/MarshallCN/EMCS/blob/master/screenshots/pc/edit%20food.png) 
## Shopping List function
![list1](https://github.com/MarshallCN/EMCS/blob/master/screenshots/pc/shopping%20list%201.png)
![list2](https://github.com/MarshallCN/EMCS/blob/master/screenshots/pc/shopping%20list%202.png)
![list3](https://github.com/MarshallCN/EMCS/blob/master/screenshots/pc/shopping%20list%203.png)
## Plan Your Meal page
This page recommend recipes based on your food in storage. You can also view most matched ingredient to gain some cooking ideas.(data from Epicurious)
![plan1](https://github.com/MarshallCN/EMCS/blob/master/screenshots/pc/Meal%20Plan%20recipes.png)
![plan2](https://github.com/MarshallCN/EMCS/blob/master/screenshots/pc/Meal%20Plan%20recipes%20detail.png)
![plan3](https://github.com/MarshallCN/EMCS/blob/master/screenshots/pc/Meal%20Plan%20recipes%20inspiration.png)
## Account Setting
You can change your password, email and profile information. Also, you can customise notification preference. (Check more details in the ./design/UserGuide.docx)
![account1](https://github.com/MarshallCN/EMCS/blob/master/screenshots/pc/setting%20account.png)
![account2](https://github.com/MarshallCN/EMCS/blob/master/screenshots/pc/setting%20preferences.png)
There are examples of two different notifications.
![noti1](https://github.com/MarshallCN/EMCS/blob/master/screenshots/pc/notification%20chrome.png)
![noti2](https://github.com/MarshallCN/EMCS/blob/master/screenshots/pc/notification%20email.png)
## Admin Page
You can access to the admin page in ./admin.php to view system information
![admin](https://github.com/MarshallCN/EMCS/blob/master/screenshots/pc/admin.png)
# Responsive Design
This system uses responsive design, which is compatible on multiple devices
![phone](https://github.com/MarshallCN/EMCS/blob/master/screenshots/phone/combined.jpg)

# Design details
## System Usage
![sys](https://github.com/MarshallCN/EMCS/blob/master/design/system%20rationale.png)
## ERD diagram
![ERD](https://github.com/MarshallCN/EMCS/blob/master/design/ERD_FINAL.png)
## Navigation
![nav](https://github.com/MarshallCN/EMCS/blob/master/design/Navigation.png)
## Data Flow
![dataflow](https://github.com/MarshallCN/EMCS/blob/master/design/data%20flow.png)
## Notification function design
![noti](https://github.com/MarshallCN/EMCS/blob/master/design/Noti.png)
## Persona
![persona](https://github.com/MarshallCN/EMCS/blob/master/design/Persona.jpg)
## Original Interface Wire-frames
![wireframe](https://github.com/MarshallCN/EMCS/blob/master/design/Interface%20wireframes/interface.png)

# About
This project is my coursework project in 2018. It also contains a questionnaire survey and user data analysis, relevent docs can be found in ./design folder
Some functions may not work on Localhost in Windows, because
	(1) the system is built to compatible with Linux online server from Hostinger.com
	(2) Atrigger function requires web server
	(3) Google Chrome Messaging service requires SSL cerificate (https://)
	(4)	It reuqired vendor file like PHPMail, which is out of the system root folder (./FYP/../vendor)
	(5) You may failed to import DB sql backup file due to its size is bigger than your default setting
	(6) Fp-growth function cost lot time, which may reach max execution time of your default setting
