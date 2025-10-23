/**
 * WordPress dependencies
 */
import { useBlockProps } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data'
/**
 * Internal dependencies
 */
import './editor.css';
import './style.css';

/**
 * Edit function for the block
 *
 * @return {Element} Element to render.
 */
export function Edit() {
	const blockProps = useBlockProps();
	const posts = useSelect( (select) => {
		return select('core').getEntityRecords('postType','recommended_list');
	},[]);
	console.log(posts);
	return (
		<div { ...blockProps }>
			<div className="company-list-placeholder">
				<h3>Company List Block</h3>
				<p>This is a starter block for displaying widget companies.</p>
				<p><strong>TODO:</strong> Implement list selection and company display.</p>
			</div>
		</div>
	);
}

/**
 * Save function for the block
 *
 * @return {Element} Element to render.
 */
export function save() {
	const blockProps = useBlockProps.save();

	return (
		<div { ...blockProps }>
			<p>Company list will be rendered here via PHP.</p>
		</div>
	);
}
