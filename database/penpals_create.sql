-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2015-07-13 13:49:35.342




-- tables
-- Table bans
CREATE TABLE bans (
    id_ban int    NOT NULL  AUTO_INCREMENT,
    ip varchar(45)    NOT NULL ,
    userid int    NOT NULL ,
    CONSTRAINT bans_pk PRIMARY KEY (id_ban)
);

-- Table countries
CREATE TABLE countries (
    id_country varchar(3)    NOT NULL ,
    cname varchar(30)    NOT NULL ,
    numcode int    NOT NULL ,
    CONSTRAINT countries_pk PRIMARY KEY (id_country)
);

-- Table friends
CREATE TABLE friends (
    sender int    NOT NULL ,
    receiver int    NOT NULL ,
    CONSTRAINT friends_pk PRIMARY KEY (sender,receiver)
);

-- Table language
CREATE TABLE language (
    id_language int    NOT NULL ,
    name varchar(16)    NOT NULL ,
    CONSTRAINT language_pk PRIMARY KEY (id_language)
);

-- Table levels
CREATE TABLE levels (
    id_level int    NOT NULL  AUTO_INCREMENT,
    description char(20)    NOT NULL ,
    dpoints int    NOT NULL DEFAULT 0 ,
    CONSTRAINT levels_pk PRIMARY KEY (id_level)
);

-- Table logs
CREATE TABLE logs (
    id_log int    NOT NULL  AUTO_INCREMENT,
    ipaddress varchar(45)    NOT NULL ,
    eventtime datetime    NOT NULL ,
    userid int    NOT NULL ,
    CONSTRAINT logs_pk PRIMARY KEY (id_log)
);

-- Table member_language
CREATE TABLE member_language (
    memberid int    NOT NULL ,
    langid int    NOT NULL ,
    CONSTRAINT member_language_pk PRIMARY KEY (memberid,langid)
);

-- Table members
CREATE TABLE members (
    id_member int    NOT NULL  AUTO_INCREMENT,
    uname varchar(20)    NOT NULL ,
    fname varchar(30)    NULL ,
    lname varchar(16)    NULL ,
    password varchar(16)    NOT NULL ,
    birthday date    NULL ,
    gender int    NULL ,
    email varchar(50)    NOT NULL ,
    referredby int    NULL ,
    address_visibility int    NULL ,
    street1 varchar(30)    NULL ,
    street2 varchar(30)    NULL ,
    zipcode varchar(20)    NULL ,
    city varchar(30)    NULL ,
    country varchar(3)    NULL ,
    level int    NOT NULL ,
    points int    NOT NULL DEFAULT 0 ,
    profilepic varchar(50)    NULL ,
    about text    NULL ,
    regdate date    NOT NULL ,
    CONSTRAINT members_pk PRIMARY KEY (id_member)
);

-- Table messages
CREATE TABLE messages (
    id_message int    NOT NULL  AUTO_INCREMENT,
    sender int    NOT NULL ,
    receiver int    NOT NULL ,
    subject varchar(50)    NOT NULL ,
    body text    NOT NULL ,
    senton datetime    NOT NULL ,
    readon datetime    NULL ,
    CONSTRAINT messages_pk PRIMARY KEY (id_message)
);

-- Table pictures
CREATE TABLE pictures (
    id_picture int    NOT NULL  AUTO_INCREMENT,
    filename varchar(50)    NOT NULL ,
    owner int    NOT NULL ,
    uploadedon date    NOT NULL ,
    description varchar(255)    NULL ,
    CONSTRAINT pictures_pk PRIMARY KEY (id_picture)
);

-- Table preferences
CREATE TABLE preferences (
    id_preference int    NOT NULL  AUTO_INCREMENT,
    p_gender int    NULL ,
    p_agemin int    NULL ,
    p_agemax int    NULL ,
    p_mail int    NOT NULL DEFAULT 0 ,
    CONSTRAINT preferences_pk PRIMARY KEY (id_preference)
);

-- Table views
CREATE TABLE views (
    id_view int    NOT NULL  AUTO_INCREMENT,
    member_id int    NOT NULL ,
    profile_id int    NOT NULL ,
    vtime datetime    NOT NULL ,
    CONSTRAINT views_pk PRIMARY KEY (id_view)
);

-- Table whoisonline
CREATE TABLE whoisonline (
    id_online int    NOT NULL ,
    time datetime    NOT NULL ,
    CONSTRAINT whoisonline_pk PRIMARY KEY (id_online)
);





-- foreign keys
-- Reference:  banned_member (table: bans)


ALTER TABLE bans ADD CONSTRAINT banned_member FOREIGN KEY banned_member (userid)
    REFERENCES members (id_member);
-- Reference:  friends_members (table: friends)


ALTER TABLE friends ADD CONSTRAINT friends_members FOREIGN KEY friends_members (sender)
    REFERENCES members (id_member);
-- Reference:  iplog_member (table: logs)


ALTER TABLE logs ADD CONSTRAINT iplog_member FOREIGN KEY iplog_member (userid)
    REFERENCES members (id_member);
-- Reference:  member_countries (table: members)


ALTER TABLE members ADD CONSTRAINT member_countries FOREIGN KEY member_countries (country)
    REFERENCES countries (id_country);
-- Reference:  member_friends (table: friends)


ALTER TABLE friends ADD CONSTRAINT member_friends FOREIGN KEY member_friends (receiver)
    REFERENCES members (id_member);
-- Reference:  member_language_language (table: member_language)


ALTER TABLE member_language ADD CONSTRAINT member_language_language FOREIGN KEY member_language_language (langid)
    REFERENCES language (id_language);
-- Reference:  member_member_language (table: member_language)


ALTER TABLE member_language ADD CONSTRAINT member_member_language FOREIGN KEY member_member_language (memberid)
    REFERENCES members (id_member);
-- Reference:  member_status (table: members)


ALTER TABLE members ADD CONSTRAINT member_status FOREIGN KEY member_status (level)
    REFERENCES levels (id_level);
-- Reference:  member_views (table: views)


ALTER TABLE views ADD CONSTRAINT member_views FOREIGN KEY member_views (profile_id)
    REFERENCES members (id_member);
-- Reference:  member_whoisonline (table: members)


ALTER TABLE members ADD CONSTRAINT member_whoisonline FOREIGN KEY member_whoisonline (id_member)
    REFERENCES whoisonline (id_online);
-- Reference:  message_member_r (table: messages)


ALTER TABLE messages ADD CONSTRAINT message_member_r FOREIGN KEY message_member_r (receiver)
    REFERENCES members (id_member);
-- Reference:  message_member_s (table: messages)


ALTER TABLE messages ADD CONSTRAINT message_member_s FOREIGN KEY message_member_s (sender)
    REFERENCES members (id_member);
-- Reference:  pictures_member (table: pictures)


ALTER TABLE pictures ADD CONSTRAINT pictures_member FOREIGN KEY pictures_member (owner)
    REFERENCES members (id_member);
-- Reference:  preferences_member (table: preferences)


ALTER TABLE preferences ADD CONSTRAINT preferences_member FOREIGN KEY preferences_member (id_preference)
    REFERENCES members (id_member);
-- Reference:  profile_member (table: views)


ALTER TABLE views ADD CONSTRAINT profile_member FOREIGN KEY profile_member (member_id)
    REFERENCES members (id_member);
-- Reference:  referred_by (table: members)


ALTER TABLE members ADD CONSTRAINT referred_by FOREIGN KEY referred_by (referredby)
    REFERENCES members (id_member);



-- End of file.

