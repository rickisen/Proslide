<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="/">
		<html>
			<body>
				<h2> Min bokhylla </h2>

				<table border="1">
					<xsl:for-each select="books/book">
						<tr>
							<td bgcolor="#ff00ff">
								<xsl:value-of select="title" />
							</td>
							<td bgcolor="#ff0000">
								<xsl:value-of select="author" />
							</td>
						</tr>

					</xsl:for-each>
				</table>
			</body>
		</html>
	</xsl:template>
</xsl:stylesheet>
