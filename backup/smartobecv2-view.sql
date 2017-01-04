
--
-- Temporary table structure for view `view_book2stat`
--

DROP TABLE IF EXISTS `view_book2stat`;
/*!50001 DROP VIEW IF EXISTS `view_book2stat`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_book2stat` (
  `post_personid` tinyint NOT NULL,
  `count_status1` tinyint NOT NULL,
  `count_status2` tinyint NOT NULL,
  `count_status20` tinyint NOT NULL,
  `count_status` tinyint NOT NULL,
  `percen_status1` tinyint NOT NULL,
  `percen_status2` tinyint NOT NULL,
  `percen_status20` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_book_person`
--

DROP TABLE IF EXISTS `view_book_person`;
/*!50001 DROP VIEW IF EXISTS `view_book_person`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_book_person` (
  `person_id` tinyint NOT NULL,
  `fullname` tinyint NOT NULL,
  `position_name` tinyint NOT NULL,
  `department_id` tinyint NOT NULL,
  `department_name` tinyint NOT NULL,
  `department_precis` tinyint NOT NULL,
  `position_fullname` tinyint NOT NULL,
  `fullname_position` tinyint NOT NULL,
  `department_fullname` tinyint NOT NULL,
  `fullname_department` tinyint NOT NULL,
  `department_position_fullname` tinyint NOT NULL,
  `fullname_position_department` tinyint NOT NULL,
  `department_typeid` tinyint NOT NULL,
  `position_code` tinyint NOT NULL,
  `department_masterid` tinyint NOT NULL,
  `department_master_precis` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_bookstat`
--

DROP TABLE IF EXISTS `view_bookstat`;
/*!50001 DROP VIEW IF EXISTS `view_bookstat`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_bookstat` (
  `post_personid` tinyint NOT NULL,
  `count_status1` tinyint NOT NULL,
  `count_status2` tinyint NOT NULL,
  `count_status20` tinyint NOT NULL,
  `count_status` tinyint NOT NULL,
  `percen_status1` tinyint NOT NULL,
  `percen_status2` tinyint NOT NULL,
  `percen_status20` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_department_group_used`
--

DROP TABLE IF EXISTS `view_department_group_used`;
/*!50001 DROP VIEW IF EXISTS `view_department_group_used`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_department_group_used` (
  `department_groupid` tinyint NOT NULL,
  `department_groupname` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_ioffice_person`
--

DROP TABLE IF EXISTS `view_ioffice_person`;
/*!50001 DROP VIEW IF EXISTS `view_ioffice_person`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_ioffice_person` (
  `person_id` tinyint NOT NULL,
  `fullname` tinyint NOT NULL,
  `position_name` tinyint NOT NULL,
  `department_id` tinyint NOT NULL,
  `department_name` tinyint NOT NULL,
  `department_precis` tinyint NOT NULL,
  `position_fullname` tinyint NOT NULL,
  `fullname_position` tinyint NOT NULL,
  `department_fullname` tinyint NOT NULL,
  `fullname_department` tinyint NOT NULL,
  `department_position_fullname` tinyint NOT NULL,
  `fullname_position_department` tinyint NOT NULL,
  `department_typeid` tinyint NOT NULL,
  `position_code` tinyint NOT NULL,
  `department_masterid` tinyint NOT NULL,
  `department_master_precis` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_modulegroup_permission`
--

DROP TABLE IF EXISTS `view_modulegroup_permission`;
/*!50001 DROP VIEW IF EXISTS `view_modulegroup_permission`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_modulegroup_permission` (
  `modulegroup` tinyint NOT NULL,
  `modulegroup_desc` tinyint NOT NULL,
  `modulegroup_icon` tinyint NOT NULL,
  `modulegroup_order` tinyint NOT NULL,
  `person_id` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_node`
--

DROP TABLE IF EXISTS `view_node`;
/*!50001 DROP VIEW IF EXISTS `view_node`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_node` (
  `nodeid` tinyint NOT NULL,
  `nodename` tinyint NOT NULL,
  `department_id` tinyint NOT NULL,
  `department_masterid` tinyint NOT NULL,
  `department_typeid` tinyint NOT NULL,
  `notetype` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_node_group`
--

DROP TABLE IF EXISTS `view_node_group`;
/*!50001 DROP VIEW IF EXISTS `view_node_group`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_node_group` (
  `nodeid` tinyint NOT NULL,
  `nodename` tinyint NOT NULL,
  `department_id` tinyint NOT NULL,
  `department_masterid` tinyint NOT NULL,
  `department_groupid` tinyint NOT NULL,
  `department_typeid` tinyint NOT NULL,
  `notetype` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_person_main`
--

DROP TABLE IF EXISTS `view_person_main`;
/*!50001 DROP VIEW IF EXISTS `view_person_main`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_person_main` (
  `person_id` tinyint NOT NULL,
  `fullname` tinyint NOT NULL,
  `position_name` tinyint NOT NULL,
  `department_id` tinyint NOT NULL,
  `department_name` tinyint NOT NULL,
  `department_precis` tinyint NOT NULL,
  `position_fullname` tinyint NOT NULL,
  `fullname_position` tinyint NOT NULL,
  `navname` tinyint NOT NULL,
  `department_fullname` tinyint NOT NULL,
  `fullname_department` tinyint NOT NULL,
  `department_position_fullname` tinyint NOT NULL,
  `fullname_position_department` tinyint NOT NULL,
  `department_typeid` tinyint NOT NULL,
  `position_code` tinyint NOT NULL,
  `department_masterid` tinyint NOT NULL,
  `department_master_precis` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_receive_person`
--

DROP TABLE IF EXISTS `view_receive_person`;
/*!50001 DROP VIEW IF EXISTS `view_receive_person`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_receive_person` (
  `person_id` tinyint NOT NULL,
  `fullname` tinyint NOT NULL,
  `position_name` tinyint NOT NULL,
  `department_id` tinyint NOT NULL,
  `department_name` tinyint NOT NULL,
  `department_precis` tinyint NOT NULL,
  `position_fullname` tinyint NOT NULL,
  `fullname_position` tinyint NOT NULL,
  `department_fullname` tinyint NOT NULL,
  `fullname_department` tinyint NOT NULL,
  `department_position_fullname` tinyint NOT NULL,
  `fullname_position_department` tinyint NOT NULL,
  `department_typeid` tinyint NOT NULL,
  `position_code` tinyint NOT NULL,
  `department_masterid` tinyint NOT NULL,
  `department_master_precis` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_system_department`
--

DROP TABLE IF EXISTS `view_system_department`;
/*!50001 DROP VIEW IF EXISTS `view_system_department`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_system_department` (
  `department_id` tinyint NOT NULL,
  `department_name` tinyint NOT NULL,
  `department_precis` tinyint NOT NULL,
  `master_department_name` tinyint NOT NULL,
  `master_department_precis` tinyint NOT NULL,
  `department_fullname` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'betasmart'
--

--
-- Dumping routines for database 'betasmart'
--

--
-- Final view structure for view `view_book2stat`
--

/*!50001 DROP TABLE IF EXISTS `view_book2stat`*/;
/*!50001 DROP VIEW IF EXISTS `view_book2stat`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`betasmart`@`%` SQL SECURITY INVOKER */
/*!50001 VIEW `view_book2stat` AS select `ioffice2_book`.`post_personid` AS `post_personid`,sum((case when ((`ioffice2_book`.`bookstatusid` = 1) or (`ioffice2_book`.`bookstatusid` = 3)) then 1 else 0 end)) AS `count_status1`,sum((case when (`ioffice2_book`.`bookstatusid` = 2) then 1 else 0 end)) AS `count_status2`,sum((case when ((`ioffice2_book`.`bookstatusid` >= 20) and (`ioffice2_book`.`bookstatusid` <= 29)) then 1 else 0 end)) AS `count_status20`,count(`ioffice2_book`.`bookid`) AS `count_status`,((sum((case when ((`ioffice2_book`.`bookstatusid` = 1) or (`ioffice2_book`.`bookstatusid` = 3)) then 1 else 0 end)) / count(`ioffice2_book`.`bookid`)) * 100) AS `percen_status1`,((sum((case when (`ioffice2_book`.`bookstatusid` = 2) then 1 else 0 end)) / count(`ioffice2_book`.`bookid`)) * 100) AS `percen_status2`,((sum((case when ((`ioffice2_book`.`bookstatusid` >= 20) and (`ioffice2_book`.`bookstatusid` <= 29)) then 1 else 0 end)) / count(`ioffice2_book`.`bookid`)) * 100) AS `percen_status20` from `ioffice2_book` group by `ioffice2_book`.`post_personid` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_book_person`
--

/*!50001 DROP TABLE IF EXISTS `view_book_person`*/;
/*!50001 DROP VIEW IF EXISTS `view_book_person`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`betasmart`@`%` SQL SECURITY INVOKER */
/*!50001 VIEW `view_book_person` AS select `person_main`.`person_id` AS `person_id`,concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) AS `fullname`,`person_position`.`position_name` AS `position_name`,`person_main`.`department_id` AS `department_id`,`sd1`.`department_name` AS `department_name`,`sd1`.`department_precis` AS `department_precis`,concat(`person_position`.`position_name`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) AS `position_fullname`,concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`person_position`.`position_name`) AS `fullname_position`,(case when isnull(`sd2`.`department_precis`) then concat(`sd1`.`department_precis`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) else concat(`sd2`.`department_precis`,' | ',`sd1`.`department_precis`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) end) AS `department_fullname`,concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`sd1`.`department_precis`) AS `fullname_department`,(case when isnull(`sd2`.`department_precis`) then concat(`sd1`.`department_precis`,' | ',`person_position`.`position_name`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) else concat(`sd2`.`department_precis`,' | ',`sd1`.`department_precis`,' | ',`person_position`.`position_name`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) end) AS `department_position_fullname`,(case when isnull(`sd2`.`department_precis`) then concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`person_position`.`position_name`,' | ',`sd1`.`department_precis`) else concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`person_position`.`position_name`,' | ',`sd1`.`department_precis`,' | ',`sd2`.`department_precis`) end) AS `fullname_position_department`,`sd1`.`department_typeid` AS `department_typeid`,`person_main`.`position_code` AS `position_code`,`sd1`.`department_masterid` AS `department_masterid`,`sd2`.`department_precis` AS `department_master_precis` from (((`person_main` left join `person_position` on((`person_main`.`position_code` = `person_position`.`position_code`))) left join `system_department` `sd1` on((`person_main`.`department_id` = `sd1`.`department_id`))) left join `system_department` `sd2` on((`sd2`.`department_id` = `sd1`.`department_masterid`))) where ((`person_main`.`status` = 1) and (`sd1`.`department_typeid` in (1,2,3))) order by `person_main`.`position_code` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_bookstat`
--

/*!50001 DROP TABLE IF EXISTS `view_bookstat`*/;
/*!50001 DROP VIEW IF EXISTS `view_bookstat`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`betasmart`@`%` SQL SECURITY INVOKER */
/*!50001 VIEW `view_bookstat` AS select `ioffice_book`.`post_personid` AS `post_personid`,sum((case when ((`ioffice_book`.`bookstatusid` = 1) or (`ioffice_book`.`bookstatusid` = 3)) then 1 else 0 end)) AS `count_status1`,sum((case when (`ioffice_book`.`bookstatusid` = 2) then 1 else 0 end)) AS `count_status2`,sum((case when ((`ioffice_book`.`bookstatusid` >= 20) and (`ioffice_book`.`bookstatusid` <= 29)) then 1 else 0 end)) AS `count_status20`,count(`ioffice_book`.`bookid`) AS `count_status`,((sum((case when ((`ioffice_book`.`bookstatusid` = 1) or (`ioffice_book`.`bookstatusid` = 3)) then 1 else 0 end)) / count(`ioffice_book`.`bookid`)) * 100) AS `percen_status1`,((sum((case when (`ioffice_book`.`bookstatusid` = 2) then 1 else 0 end)) / count(`ioffice_book`.`bookid`)) * 100) AS `percen_status2`,((sum((case when ((`ioffice_book`.`bookstatusid` >= 20) and (`ioffice_book`.`bookstatusid` <= 29)) then 1 else 0 end)) / count(`ioffice_book`.`bookid`)) * 100) AS `percen_status20` from `ioffice_book` group by `ioffice_book`.`post_personid` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_department_group_used`
--

/*!50001 DROP TABLE IF EXISTS `view_department_group_used`*/;
/*!50001 DROP VIEW IF EXISTS `view_department_group_used`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`betasmart`@`%` SQL SECURITY INVOKER */
/*!50001 VIEW `view_department_group_used` AS select `system_department_groupmember`.`department_groupid` AS `department_groupid`,`system_department_group`.`department_groupname` AS `department_groupname` from (`system_department_groupmember` left join `system_department_group` on((`system_department_groupmember`.`department_groupid` = `system_department_group`.`department_groupid`))) group by `system_department_groupmember`.`department_groupid` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_ioffice_person`
--

/*!50001 DROP TABLE IF EXISTS `view_ioffice_person`*/;
/*!50001 DROP VIEW IF EXISTS `view_ioffice_person`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`betasmart`@`%` SQL SECURITY INVOKER */
/*!50001 VIEW `view_ioffice_person` AS select `person_main`.`person_id` AS `person_id`,concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) AS `fullname`,`person_position`.`position_name` AS `position_name`,`person_main`.`department_id` AS `department_id`,`sd1`.`department_name` AS `department_name`,`sd1`.`department_precis` AS `department_precis`,concat(`person_position`.`position_name`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) AS `position_fullname`,concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`person_position`.`position_name`) AS `fullname_position`,(case when isnull(`sd2`.`department_precis`) then concat(`sd1`.`department_precis`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) else concat(`sd2`.`department_precis`,' | ',`sd1`.`department_precis`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) end) AS `department_fullname`,concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`sd1`.`department_precis`) AS `fullname_department`,(case when isnull(`sd2`.`department_precis`) then concat(`sd1`.`department_precis`,' | ',`person_position`.`position_name`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) else concat(`sd2`.`department_precis`,' | ',`sd1`.`department_precis`,' | ',`person_position`.`position_name`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) end) AS `department_position_fullname`,(case when isnull(`sd2`.`department_precis`) then concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`person_position`.`position_name`,' | ',`sd1`.`department_precis`) else concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`person_position`.`position_name`,' | ',`sd1`.`department_precis`,' | ',`sd2`.`department_precis`) end) AS `fullname_position_department`,`sd1`.`department_typeid` AS `department_typeid`,`person_main`.`position_code` AS `position_code`,`sd1`.`department_masterid` AS `department_masterid`,`sd2`.`department_precis` AS `department_master_precis` from (((`person_main` left join `person_position` on((`person_main`.`position_code` = `person_position`.`position_code`))) left join `system_department` `sd1` on((`person_main`.`department_id` = `sd1`.`department_id`))) left join `system_department` `sd2` on((`sd2`.`department_id` = `sd1`.`department_masterid`))) where ((`person_main`.`status` = 1) and (`sd1`.`department_typeid` in (1,2,3))) order by `person_main`.`position_code` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_modulegroup_permission`
--

/*!50001 DROP TABLE IF EXISTS `view_modulegroup_permission`*/;
/*!50001 DROP VIEW IF EXISTS `view_modulegroup_permission`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`betasmart`@`%` SQL SECURITY INVOKER */
/*!50001 VIEW `view_modulegroup_permission` AS select `system_modulegroup`.`modulegroup` AS `modulegroup`,`system_modulegroup`.`modulegroup_desc` AS `modulegroup_desc`,`system_modulegroup`.`modulegroup_icon` AS `modulegroup_icon`,`system_modulegroup`.`modulegroup_order` AS `modulegroup_order`,`person_groupmember`.`person_id` AS `person_id` from ((((`system_modulegroup` join `system_module` on((`system_modulegroup`.`modulegroup` = `system_module`.`workgroup`))) join `system_menu` on((`system_module`.`module` = `system_menu`.`module`))) join `system_menumember` on((`system_menu`.`menu_id` = `system_menumember`.`menu_id`))) join `person_groupmember` on((`system_menumember`.`person_groupid` = `person_groupmember`.`person_groupid`))) where (`system_menu`.`menu_statusid` = 1) group by `system_modulegroup`.`modulegroup`,`system_modulegroup`.`modulegroup_desc`,`system_modulegroup`.`modulegroup_icon`,`system_modulegroup`.`modulegroup_order`,`person_groupmember`.`person_id` order by `system_modulegroup`.`modulegroup_order` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_node`
--

/*!50001 DROP TABLE IF EXISTS `view_node`*/;
/*!50001 DROP VIEW IF EXISTS `view_node`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`betasmart`@`%` SQL SECURITY INVOKER */
/*!50001 VIEW `view_node` AS select concat('P',`person_main`.`person_id`) AS `nodeid`,(case when ((`sd`.`department_masterid` = 0) or (`sd`.`department_masterid` = NULL)) then concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`person_position`.`position_name`,' | ',`sd`.`department_precis`) else concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`person_position`.`position_name`,' | ',`sd`.`department_precis`,' | ',`sdm`.`department_precis`) end) AS `nodename`,`person_main`.`department_id` AS `department_id`,`person_main`.`department_id` AS `department_masterid`,`sd`.`department_typeid` AS `department_typeid`,'person' AS `notetype` from (((`person_main` left join `person_position` on((`person_main`.`position_code` = `person_position`.`position_code`))) left join `system_department` `sd` on((`person_main`.`department_id` = `sd`.`department_id`))) left join `system_department` `sdm` on((`sd`.`department_masterid` = `sdm`.`department_id`))) union all select concat('D',`sd`.`department_id`) AS `nodeid`,(case when ((`sd`.`department_masterid` = 0) or (`sd`.`department_masterid` = NULL)) then `sd`.`department_precis` else concat(`sdm`.`department_precis`,' | ',`sd`.`department_precis`) end) AS `nodename`,`sd`.`department_id` AS `department_id`,`sd`.`department_masterid` AS `department_masterid`,`sd`.`department_typeid` AS `department_typeid`,'department' AS `notetype` from (`system_department` `sd` left join `system_department` `sdm` on((`sd`.`department_masterid` = `sdm`.`department_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_node_group`
--

/*!50001 DROP TABLE IF EXISTS `view_node_group`*/;
/*!50001 DROP VIEW IF EXISTS `view_node_group`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`betasmart`@`%` SQL SECURITY INVOKER */
/*!50001 VIEW `view_node_group` AS select concat('P',`person_main`.`person_id`) AS `nodeid`,(case when ((`sd`.`department_masterid` = 0) or (`sd`.`department_masterid` = NULL)) then concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`person_position`.`position_name`,' | ',`sd`.`department_precis`) else concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`person_position`.`position_name`,' | ',`sd`.`department_precis`,' | ',`sdm`.`department_precis`) end) AS `nodename`,`person_main`.`department_id` AS `department_id`,`person_main`.`department_id` AS `department_masterid`,0 AS `department_groupid`,`sd`.`department_typeid` AS `department_typeid`,'person' AS `notetype` from (((`person_main` left join `person_position` on((`person_main`.`position_code` = `person_position`.`position_code`))) left join `system_department` `sd` on((`person_main`.`department_id` = `sd`.`department_id`))) left join `system_department` `sdm` on((`sd`.`department_masterid` = `sdm`.`department_id`))) union all select concat('D',`sd`.`department_id`) AS `nodeid`,(case when ((`sd`.`department_masterid` = 0) or (`sd`.`department_masterid` = NULL)) then `sd`.`department_name` else concat(`sdm`.`department_precis`,' | ',`sd`.`department_name`) end) AS `nodename`,`sd`.`department_id` AS `department_id`,`sd`.`department_masterid` AS `department_masterid`,`sdg`.`department_groupid` AS `department_groupid`,`sd`.`department_typeid` AS `department_typeid`,'department' AS `notetype` from ((`system_department` `sd` left join `system_department` `sdm` on((`sd`.`department_masterid` = `sdm`.`department_id`))) left join `system_department_groupmember` `sdg` on((`sd`.`department_id` = `sdg`.`department_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_person_main`
--

/*!50001 DROP TABLE IF EXISTS `view_person_main`*/;
/*!50001 DROP VIEW IF EXISTS `view_person_main`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`betasmart`@`%` SQL SECURITY INVOKER */
/*!50001 VIEW `view_person_main` AS select `person_main`.`person_id` AS `person_id`,concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) AS `fullname`,`person_position`.`position_name` AS `position_name`,`person_main`.`department_id` AS `department_id`,`sd1`.`department_name` AS `department_name`,`sd1`.`department_precis` AS `department_precis`,concat(`person_position`.`position_name`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) AS `position_fullname`,concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`person_position`.`position_name`) AS `fullname_position`,concat(`person_main`.`name`,' ',`person_main`.`surname`,' | ',`sd1`.`department_precis`) AS `navname`,(case when isnull(`sd2`.`department_precis`) then concat(`sd1`.`department_precis`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) else concat(`sd2`.`department_precis`,' | ',`sd1`.`department_precis`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) end) AS `department_fullname`,concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`sd1`.`department_precis`) AS `fullname_department`,(case when isnull(`sd2`.`department_precis`) then concat(`sd1`.`department_precis`,' | ',`person_position`.`position_name`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) else concat(`sd2`.`department_precis`,' | ',`sd1`.`department_precis`,' | ',`person_position`.`position_name`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) end) AS `department_position_fullname`,(case when isnull(`sd2`.`department_precis`) then concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`person_position`.`position_name`,' | ',`sd1`.`department_precis`) else concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`person_position`.`position_name`,' | ',`sd1`.`department_precis`,' | ',`sd2`.`department_precis`) end) AS `fullname_position_department`,`sd1`.`department_typeid` AS `department_typeid`,`person_main`.`position_code` AS `position_code`,`sd1`.`department_masterid` AS `department_masterid`,`sd2`.`department_precis` AS `department_master_precis` from (((`person_main` left join `person_position` on((`person_main`.`position_code` = `person_position`.`position_code`))) left join `system_department` `sd1` on((`person_main`.`department_id` = `sd1`.`department_id`))) left join `system_department` `sd2` on((`sd2`.`department_id` = `sd1`.`department_masterid`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_receive_person`
--

/*!50001 DROP TABLE IF EXISTS `view_receive_person`*/;
/*!50001 DROP VIEW IF EXISTS `view_receive_person`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`betasmart`@`%` SQL SECURITY INVOKER */
/*!50001 VIEW `view_receive_person` AS select `person_main`.`person_id` AS `person_id`,concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) AS `fullname`,`person_position`.`position_name` AS `position_name`,`person_main`.`department_id` AS `department_id`,`sd1`.`department_name` AS `department_name`,`sd1`.`department_precis` AS `department_precis`,concat(`person_position`.`position_name`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) AS `position_fullname`,concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`person_position`.`position_name`) AS `fullname_position`,(case when isnull(`sd2`.`department_precis`) then concat(`sd1`.`department_precis`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) else concat(`sd2`.`department_precis`,' | ',`sd1`.`department_precis`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) end) AS `department_fullname`,concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`sd1`.`department_precis`) AS `fullname_department`,(case when isnull(`sd2`.`department_precis`) then concat(`sd1`.`department_precis`,' | ',`person_position`.`position_name`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) else concat(`sd2`.`department_precis`,' | ',`sd1`.`department_precis`,' | ',`person_position`.`position_name`,' | ',`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`) end) AS `department_position_fullname`,(case when isnull(`sd2`.`department_precis`) then concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`person_position`.`position_name`,' | ',`sd1`.`department_precis`) else concat(`person_main`.`prename`,' ',`person_main`.`name`,' ',`person_main`.`surname`,' | ',`person_position`.`position_name`,' | ',`sd1`.`department_precis`,' | ',`sd2`.`department_precis`) end) AS `fullname_position_department`,`sd1`.`department_typeid` AS `department_typeid`,`person_main`.`position_code` AS `position_code`,`sd1`.`department_masterid` AS `department_masterid`,`sd2`.`department_precis` AS `department_master_precis` from (((`person_main` left join `person_position` on((`person_main`.`position_code` = `person_position`.`position_code`))) left join `system_department` `sd1` on((`person_main`.`department_id` = `sd1`.`department_id`))) left join `system_department` `sd2` on((`sd2`.`department_id` = `sd1`.`department_masterid`))) where ((`person_main`.`status` = 1) and (`person_main`.`position_code` <= 11)) order by `person_main`.`position_code` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_system_department`
--

/*!50001 DROP TABLE IF EXISTS `view_system_department`*/;
/*!50001 DROP VIEW IF EXISTS `view_system_department`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`betasmart`@`%` SQL SECURITY INVOKER */
/*!50001 VIEW `view_system_department` AS select `sd1`.`department_id` AS `department_id`,`sd1`.`department_name` AS `department_name`,`sd1`.`department_precis` AS `department_precis`,`sd2`.`department_name` AS `master_department_name`,`sd2`.`department_precis` AS `master_department_precis`,(case when (`sd2`.`department_precis` is not null) then concat(`sd1`.`department_precis`,' | ',`sd2`.`department_precis`) else `sd1`.`department_precis` end) AS `department_fullname` from (`system_department` `sd1` left join `system_department` `sd2` on((`sd1`.`department_masterid` = `sd2`.`department_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
