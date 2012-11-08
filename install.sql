CREATE TABLE IF NOT EXISTS `#__schedule_abonements` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор',
  `num` varchar(30) NOT NULL COMMENT '№ абонемента',
  `client_id` int(11) NOT NULL COMMENT 'ИД клиента',
  `abonement_type_id` int(3) NOT NULL COMMENT 'ИД типа документа',
  `sale_date` date NOT NULL COMMENT 'Дата продажи',
  `activate_period` int(5) NOT NULL COMMENT 'Срок активации',
  `activate_date` date NOT NULL COMMENT 'Дата активации',
  `validity_period` int(5) NOT NULL COMMENT 'Срок действия',
  PRIMARY KEY (`id`),
  KEY `num` (`num`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Абонементы и клубные карты' AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__schedule_abonement_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT 'Наименование типа документа',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Типы документов для посещения занятий' AUTO_INCREMENT=3 ;

INSERT INTO `#__schedule_abonement_types` (`id`, `name`) VALUES
(1, 'абонемент'),
(2, 'клубная карта');

CREATE TABLE IF NOT EXISTS `#__schedule_calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `training_id` int(11) NOT NULL COMMENT 'ИД занятия',
  `trainer_id` int(11) NOT NULL COMMENT 'ИД преподавателя',
  `date` date NOT NULL COMMENT 'Дата проведения',
  `time_start` time NOT NULL COMMENT 'Время начала занятия',
  `time_stop` time NOT NULL COMMENT 'Время окончания занятия',
  `max_clients` int(3) NOT NULL COMMENT 'Макс. кол-во клиентов',
  `training_status_id` int(2) NOT NULL COMMENT 'ИД статуса занятия',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Расписание занятий' AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__schedule_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '№ клиента',
  `fam` varchar(50) NOT NULL,
  `im` varchar(50) NOT NULL COMMENT 'Имя',
  `ot` varchar(50) NOT NULL COMMENT 'Отчество',
  `phone` varchar(50) NOT NULL COMMENT 'Контактный телефон ',
  `email` varchar(50) NOT NULL COMMENT 'E-mail',
  PRIMARY KEY (`id`),
  KEY `fam` (`fam`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT=' Клиенты' AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__schedule_freezings` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД заморозки',
  `abonement_id` int(11) NOT NULL COMMENT 'ИД абонемента',
  `date_from` date NOT NULL COMMENT 'Дата начала',
  `date_to` date NOT NULL COMMENT 'Дата окончания',

  PRIMARY KEY (`id`),
  KEY `abonement_id` (`abonement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Заморозки документов';

CREATE TABLE IF NOT EXISTS `#__schedule_prolongations` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ИД заморозки',
  `abonement_id` int(11) NOT NULL COMMENT 'ИД абонемента',
  `date_from` date NOT NULL COMMENT 'Дата начала',
  `date_to` date NOT NULL COMMENT 'Дата окончания',

  PRIMARY KEY (`id`),
  KEY `abonement_id` (`abonement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Заморозки документов';

CREATE TABLE IF NOT EXISTS `#__schedule_trainers` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '№ преподавателя',
  `im` varchar(50) NOT NULL COMMENT 'Имя',
  `fam` varchar(50) NOT NULL COMMENT 'Фамилия',
  `ot` varchar(50) NOT NULL COMMENT 'Отчество',
  `phone` varchar(50) NOT NULL COMMENT 'Контактный телефон',
  `trainer_link` varchar(500) NOT NULL COMMENT 'Ссылка на статью преподавателя',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Преподаватели' AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__schedule_trainings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trainer_id` int(11) NOT NULL COMMENT 'ИД преподавателя',
  `name` varchar(50) NOT NULL COMMENT 'Название занятия',
  `week_day` int(1) NOT NULL COMMENT 'День недели, в которое проводится занятие',
  `time_start` time NOT NULL COMMENT 'Время начала занятия',
  `time_stop` time NOT NULL COMMENT 'Время окончания занятия',
  `date_start` date NOT NULL COMMENT 'Дата начала проведения занятий',
  `date_stop` date NOT NULL COMMENT 'Дата окончания проведения занятий',
  `max_clients` int(3) NOT NULL COMMENT 'Макс. кол-во клиентов',
  `training_link` varchar(500) NOT NULL COMMENT 'Ссылка на статью занятия',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Занятия' AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `#__schedule_training_statuses` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT 'Наименование статуса занятия',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Статусы занятий' AUTO_INCREMENT=4 ;

INSERT INTO `#__schedule_training_statuses` (`id`, `name`) VALUES
(1, 'Запланировано'),
(2, 'Отменено'),
(3, 'Состоялось');

CREATE TABLE IF NOT EXISTS `#__schedule_training_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT 'Наименование типа посещения',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Типы посещения занятий' AUTO_INCREMENT=5 ;

INSERT INTO `#__schedule_training_types` (`id`, `name`) VALUES
(1, 'абонемент'),
(2, 'клубная карта'),
(3, 'разовое посещение'),
(4, 'разовое посещение по купону');

CREATE TABLE IF NOT EXISTS `#__schedule_visits` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '№ посещения/записи',
  `client_id` int(11) NOT NULL COMMENT 'ИД клиента',
  `calendar_id` int(11) NOT NULL COMMENT 'ИД расписания',
  `training_type_id` int(3) NOT NULL COMMENT 'ИД типа посещения',
  `registered` tinyint(1) NOT NULL COMMENT 'Записался',
  `visited` tinyint(1) NOT NULL COMMENT 'Посетил',
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Посещения занятий и предварительная запись на занятия' AUTO_INCREMENT=1 ;
