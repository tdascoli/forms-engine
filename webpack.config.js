const path = require("path");

module.exports = {
  mode: "production",
  output: {
    filename: "formsEngine.min.js"
  },
  module: {
    rules: [
      {
        test: /\.js?$/,
        include: [path.resolve(__dirname, "./src/assets/js")],
        loader: "babel-loader"
      }
    ]
  }
};
