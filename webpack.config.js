const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
module.exports = {
  mode: 'development',
  watch: true,
  entry: {
    'js/app' : './src/js/app.js',
    'js/inicio' : './src/js/inicio.js',
    'js/insumo/index' : './src/js/insumo/index.js',
    'js/operaciones/index' : './src/js/operaciones/index.js',
    'js/medios/index' : './src/js/medios/index.js',
    'js/receptores/index' : './src/js/receptores/index.js',
    'js/tipo_embarcaciones/index' : './src/js/tipo_embarcaciones/index.js',
    'js/embarcaciones/index' : './src/js/embarcaciones/index.js',
    'js/motores/index' : './src/js/motores/index.js',
    'js/unidad_medida/index' : './src/js/unidad_medida/index.js',
    
    
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'public/build')
  },
  plugins: [
    new MiniCssExtractPlugin({
        filename: 'styles.css'
    })
  ],
  module: {
    rules: [
      {
        test: /\.(c|sc|sa)ss$/,
        use: [
            {
                loader: MiniCssExtractPlugin.loader
            },
            'css-loader',
            'sass-loader'
        ]
      },
      {
        test: /\.(png|svg|jpg|gif)$/,
        loader: 'file-loader',
        options: {
           name: 'img/[name].[hash:7].[ext]'
        }
      },
    ]
  }
};