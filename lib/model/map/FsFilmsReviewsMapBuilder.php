<?php


/**
 * This class adds structure of 'fs_films_reviews' table to 'propel' DatabaseMap object.
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
class FsFilmsReviewsMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.FsFilmsReviewsMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(FsFilmsReviewsPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(FsFilmsReviewsPeer::TABLE_NAME);
		$tMap->setPhpName('FsFilmsReviews');
		$tMap->setClassname('FsFilmsReviews');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('REVIEW_ID', 'ReviewId', 'INTEGER', true, null);

		$tMap->addForeignKey('FILM_ID', 'FilmId', 'INTEGER', 'fs_films', 'FILM_ID', true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'sf_guard_user', 'ID', true, null);

		$tMap->addColumn('REVIEW_CONTENT', 'ReviewContent', 'LONGVARCHAR', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

	} // doBuild()

} // FsFilmsReviewsMapBuilder
