/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import * as companyList from './blocks/company-list/edit';
import metadata from './blocks/company-list/block.json';

/**
 * Register the Company List block
 */
registerBlockType( metadata.name, {
	...metadata,
	edit: companyList.Edit,
	save: companyList.save,
} );
