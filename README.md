# SlashAh

# A9: Product

SlashAh is a simple yet effective auction platform. It aims to provide a service 
for both sellers and buyers, mainly targetting ease of usability for the 
entry-level user and deep customization for the advanced one, while maintaining 
an appealing design.
In this artefact we show all the implemented user stories, the code validation 
and some instructions to use SlashAh, we ended up with a fast, clear and good 
looking auction platform, with auction creation, bidding, notifications, user 
profiles, categories and reports, all for our regular users. We also have 
moderation, where we can ban users or suggest them for moderation, cancel 
auctions and check reports from users. Finally we have the administration 
section with all acess to moderation information and actions, and acess to 
website statistics such as auctions per category and money spent on each 
category.

## 1. Installation

The release source code can be accessed [here](https://git.fe.up.pt/lbaw/lbaw1920/lbaw2062/-/tree/A9)

In order to build the project from the source code run:
```shell
docker build -t lbaw2062/lbaw2062 .
```

In order to pull the Docker image from Docker Hub run:
```shell
docker pull lbaw2062/lbaw2062
```

In order to run the project run:
```shell
docker run -it -p 8000:80 -e DB_DATABASE="lbaw2062" -e DB_USERNAME="lbaw2062" -e DB_PASSWORD="QV933187" lbaw2062/lbaw2062
```

The local image can then be accessed in `localhost:8000`

### Team

* Gonçalo Pereira, up201705971@fe.up.pt
* João Pedro Campos, up201704982@fe.up.pt
* João Renato Pinto, up201705547@fe.up.pt
* Leonardo Moura, up201706907@fe.up.pt

**For more information check out the project [Wiki](../wikis/home)**

***
GROUP2062, 18/02/2020