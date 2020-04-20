const path = require('path');

const config = {
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader"
        }
      }
    ],
  },
  output: {
    filename: 'typed-form.js',
    path: path.resolve(__dirname, 'dist')
  },
  devtool: 'source-map'
};

module.exports = (env, argv) => {
  return config;
};
