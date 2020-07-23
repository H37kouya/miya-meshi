import Document, { DocumentContext, Html, Head, Main, NextScript } from 'next/document';
import { ServerStyleSheet as StyledComponentSheets } from 'styled-components';
import { ServerStyleSheets as MaterialUiServerStyleSheets } from '@material-ui/styles';

class MyDocument extends Document {
  static async getInitialProps(ctx: DocumentContext) {
    const styledComponentSheets = new StyledComponentSheets();
    const materialUiServerStyleSheets = new MaterialUiServerStyleSheets();
    const originalRenderPage = ctx.renderPage;

    try {
      ctx.renderPage = () =>
        originalRenderPage({
          enhanceApp: App => props =>
            styledComponentSheets.collectStyles(
              materialUiServerStyleSheets.collect(<App {...props} />)
            )
        });

      const initialProps = await Document.getInitialProps(ctx);
      return {
        ...initialProps,
        styles: (
          <>
            {initialProps.styles}
            {styledComponentSheets.getStyleElement()}
            {materialUiServerStyleSheets.getStyleElement()}
          </>
        )
      };
    } finally {
      styledComponentSheets.seal();
    }
  }

  render() {
    return (
      <Html lang="ja">
          <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
          />
          <link rel="icon" href="/favicon.ico" />
        <Head />
        <body>
          <Main />
          <NextScript />
        </body>
      </Html>
    );
  }
}

export default MyDocument