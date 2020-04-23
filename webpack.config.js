const path = require('path');
const Autoprefixer = require('autoprefixer');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = (env) => {
  const dev = (env && env.dev);
  const sourceMaps = !dev;

  const postCssPlugins = _ => {
    return Autoprefixer({
      cascade: sourceMaps
    });
  };

  return {
    target: 'web',
    mode: 'production',
    context: path.resolve(__dirname, 'assets'),
    entry: './index.js',
    output: {
      path: path.resolve(__dirname, 'src/Resources/public/'),
      filename: `[name].js`,
    },
    devtool: 'source-map',
    module: {
      rules: [
        // Es6
        {
          test: /\.(js|jsx)$/,
          exclude: /node_modules/,
          loader: 'babel-loader',
        },
        // Sass
        {
          test: /\.s[ac]ss$/i,
          use: [
            MiniCssExtractPlugin.loader,
            {
              loader: 'css-loader',
              options: { sourceMap: sourceMaps }
            },
            {
              loader: 'postcss-loader',
              options: { plugins: postCssPlugins, sourceMap: sourceMaps }
            },
            {
              loader: 'sass-loader',
              options: { sourceMap: sourceMaps }
            }
          ],
        }
      ]
    },
    plugins: [
      new MiniCssExtractPlugin({
        filename: `[name].css`,
        chunkFilename: `[id].css`,
      })
    ],
    resolve: {
      extensions: ['.js']
    }
  };
}
