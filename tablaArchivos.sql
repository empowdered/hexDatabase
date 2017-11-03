USE [prueba]
GO
/****** Object:  Table [dbo].[archivo]    Script Date: 11/03/2017 16:04:01 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[archivo](
	[nbArchivo] [nvarchar](200) NULL,
	[tipoArchivo] [nvarchar](100) NULL,
	[nbTemporal] [nvarchar](200) NULL,
	[tamanoArchivo] [bigint] NULL,
	[contenido] [image] NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
