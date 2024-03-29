<?php


/**
 * This class adds structure of 'fs_films_reviews_comments' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Wed Mar 11 23:15:47 2009
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class FsFilmsReviewsCommentsMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.FsFilmsReviewsCommentsMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(FsFilmsReviewsCommentsPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(FsFilmsReviewsCommentsPeer::TABLE_NAME);
		$tMap->setPhpName('FsFilmsReviewsComments');
		$tMap->setClassname('FsFilmsReviewsComments');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('REVIEW_COMMENT_ID', 'ReviewCommentId', 'INTEGER', true, null);

		$tMap->addForeignKey('REVIEW_ID', 'ReviewId', 'INTEGER', 'fs_films_reviews', 'REVIEW_ID', true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

	} // doBuild()

} // FsFilmsReviewsCommentsMapBuilder
