process.env.WP_COPY_PHP_FILES_TO_DIST = true;
process.env.WP_BLOCKS_MANIFEST = true;
process.env.WP_SOURCE_PATH = './wp-content/plugins/learnsphere-plugin/src';
process.env.WP_SOURCE_PATH = "./wp-content/themes/twenty-learnsphere-child/src";

const path = require('path');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const { getWebpackEntryPoints } = require('@wordpress/scripts/utils/config');

const pluginConfig = {
	...defaultConfig,
	entry: {
		...getWebpackEntryPoints('script')(),
		plugin: path.resolve(__dirname, 'wp-content/plugins/learnsphere-plugin/src/index.js'),
	},
	output: {
		path: path.resolve(__dirname, 'wp-content/plugins/learnsphere-plugin/build'),
		filename: '[name].js',
		clean: true 
	}
};

const themeConfig = {
  ...defaultConfig,
  entry: {
    // Default script entry points (e.g. for blocks)
    ...getWebpackEntryPoints("script")(),
  },
  output: {
    path: path.resolve(__dirname, "wp-content/themes/twenty-learnsphere-child/build"),
    filename: "[name].js",
    clean: true,
  },
};

module.exports = [pluginConfig,themeConfig];
