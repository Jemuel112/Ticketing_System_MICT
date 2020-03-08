USE [master]
GO
/****** Object:  Database [MCU_MICT]    Script Date: 02/21/2020 4:40:53 PM ******/
CREATE DATABASE [MCU_MICT]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'MCU_MICT', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL11.MSSQLSERVER20212\MSSQL\DATA\MCU_MICT.mdf' , SIZE = 3072KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'MCU_MICT_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL11.MSSQLSERVER20212\MSSQL\DATA\MCU_MICT_log.ldf' , SIZE = 1024KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [MCU_MICT] SET COMPATIBILITY_LEVEL = 110
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [MCU_MICT].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [MCU_MICT] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [MCU_MICT] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [MCU_MICT] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [MCU_MICT] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [MCU_MICT] SET ARITHABORT OFF 
GO
ALTER DATABASE [MCU_MICT] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [MCU_MICT] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [MCU_MICT] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [MCU_MICT] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [MCU_MICT] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [MCU_MICT] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [MCU_MICT] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [MCU_MICT] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [MCU_MICT] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [MCU_MICT] SET  DISABLE_BROKER 
GO
ALTER DATABASE [MCU_MICT] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [MCU_MICT] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [MCU_MICT] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [MCU_MICT] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [MCU_MICT] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [MCU_MICT] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [MCU_MICT] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [MCU_MICT] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [MCU_MICT] SET  MULTI_USER 
GO
ALTER DATABASE [MCU_MICT] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [MCU_MICT] SET DB_CHAINING OFF 
GO
ALTER DATABASE [MCU_MICT] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [MCU_MICT] SET TARGET_RECOVERY_TIME = 0 SECONDS 
GO
USE [MCU_MICT]
GO
/****** Object:  Table [dbo].[departments]    Script Date: 02/21/2020 4:40:53 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[departments](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[dept_name] [nvarchar](255) NOT NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[m_tickets]    Script Date: 02/21/2020 4:40:53 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[m_tickets](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[reported_by] [nvarchar](255) NULL,
	[request_by] [nvarchar](255) NULL,
	[status] [nvarchar](255) NULL,
	[og_status] [nvarchar](255) NULL,
	[start_at] [datetime] NULL,
	[end_at] [datetime] NULL,
	[acknowledge_by] [nvarchar](255) NULL,
	[assigned_to] [nvarchar](255) NULL,
	[assisted_by] [nvarchar](255) NULL,
	[accomplished_by] [nvarchar](255) NULL,
	[category] [nvarchar](255) NULL,
	[sys_category] [nvarchar](255) NULL,
	[lop] [nvarchar](255) NULL,
	[concerns] [nvarchar](max) NULL,
	[recommendation] [nvarchar](max) NULL,
	[created_by] [nvarchar](255) NULL,
	[updated_by] [nvarchar](255) NULL,
	[is_new] [bit] NOT NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
	[finished_at] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[mactions]    Script Date: 02/21/2020 4:40:53 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[mactions](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[actions] [nvarchar](max) NOT NULL,
	[id_mticket] [bigint] NOT NULL,
	[id_user] [bigint] NOT NULL,
	[shared] [bit] NOT NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[mcomments]    Script Date: 02/21/2020 4:40:53 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[mcomments](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[comments] [nvarchar](max) NOT NULL,
	[id_mticket] [bigint] NOT NULL,
	[id_user] [bigint] NOT NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[migrations]    Script Date: 02/21/2020 4:40:53 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[migrations](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[migration] [nvarchar](255) NOT NULL,
	[batch] [int] NOT NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[users]    Script Date: 02/21/2020 4:40:53 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[users](
	[id] [bigint] IDENTITY(1,1) NOT NULL,
	[username] [nvarchar](255) NOT NULL,
	[fname] [nvarchar](255) NOT NULL,
	[lname] [nvarchar](255) NULL,
	[department] [nvarchar](255) NOT NULL,
	[password] [nvarchar](255) NOT NULL,
	[remember_token] [nvarchar](100) NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[departments] ON 

INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (1, N'Admin', CAST(N'2020-02-18T12:02:21.813' AS DateTime), CAST(N'2020-02-18T12:02:21.813' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (2, N'Anatomy', CAST(N'2020-02-18T12:02:21.817' AS DateTime), CAST(N'2020-02-18T12:02:21.817' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (3, N'Accounting', CAST(N'2020-02-18T12:02:21.817' AS DateTime), CAST(N'2020-02-18T12:02:21.817' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (4, N'Anesthesia', CAST(N'2020-02-18T12:02:21.817' AS DateTime), CAST(N'2020-02-18T12:02:21.817' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (5, N'ACSU', CAST(N'2020-02-18T12:02:21.820' AS DateTime), CAST(N'2020-02-18T12:02:21.820' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (6, N'Admitting', CAST(N'2020-02-18T12:02:21.820' AS DateTime), CAST(N'2020-02-18T12:02:21.820' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (7, N'Audit', CAST(N'2020-02-18T12:02:21.820' AS DateTime), CAST(N'2020-02-18T12:02:21.820' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (8, N'Billing', CAST(N'2020-02-18T12:02:21.820' AS DateTime), CAST(N'2020-02-18T12:02:21.820' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (9, N'BGC', CAST(N'2020-02-18T12:02:21.823' AS DateTime), CAST(N'2020-02-18T12:02:21.823' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (10, N'Biochemistry', CAST(N'2020-02-18T12:02:21.823' AS DateTime), CAST(N'2020-02-18T12:02:21.823' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (11, N'CPS', CAST(N'2020-02-18T12:02:21.823' AS DateTime), CAST(N'2020-02-18T12:02:21.823' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (12, N'Cashier', CAST(N'2020-02-18T12:02:21.823' AS DateTime), CAST(N'2020-02-18T12:02:21.823' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (13, N'CCU', CAST(N'2020-02-18T12:02:21.827' AS DateTime), CAST(N'2020-02-18T12:02:21.827' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (14, N'CSR', CAST(N'2020-02-18T12:02:21.827' AS DateTime), CAST(N'2020-02-18T12:02:21.827' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (15, N'Chemo', CAST(N'2020-02-18T12:02:21.827' AS DateTime), CAST(N'2020-02-18T12:02:21.827' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (16, N'Credit & Collection', CAST(N'2020-02-18T12:02:21.827' AS DateTime), CAST(N'2020-02-18T12:02:21.827' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (17, N'CT-Scan', CAST(N'2020-02-18T12:02:21.843' AS DateTime), CAST(N'2020-02-18T12:02:21.843' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (18, N'DR', CAST(N'2020-02-18T12:02:21.843' AS DateTime), CAST(N'2020-02-18T12:02:21.843' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (19, N'Doctors Office', CAST(N'2020-02-18T12:02:21.843' AS DateTime), CAST(N'2020-02-18T12:02:21.843' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (20, N'Dietary-MCU', CAST(N'2020-02-18T12:02:21.843' AS DateTime), CAST(N'2020-02-18T12:02:21.843' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (21, N'Deans Office', CAST(N'2020-02-18T12:02:21.847' AS DateTime), CAST(N'2020-02-18T12:02:21.847' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (22, N'Engineering', CAST(N'2020-02-18T12:02:21.847' AS DateTime), CAST(N'2020-02-18T12:02:21.847' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (23, N'ER', CAST(N'2020-02-18T12:02:21.847' AS DateTime), CAST(N'2020-02-18T12:02:21.847' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (24, N'Endoscopy', CAST(N'2020-02-18T12:02:21.847' AS DateTime), CAST(N'2020-02-18T12:02:21.847' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (25, N'ENT', CAST(N'2020-02-18T12:02:21.847' AS DateTime), CAST(N'2020-02-18T12:02:21.847' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (26, N'EVP', CAST(N'2020-02-18T12:02:21.847' AS DateTime), CAST(N'2020-02-18T12:02:21.847' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (27, N'Ethics', CAST(N'2020-02-18T12:02:21.847' AS DateTime), CAST(N'2020-02-18T12:02:21.847' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (28, N'FCM', CAST(N'2020-02-18T12:02:21.847' AS DateTime), CAST(N'2020-02-18T12:02:21.847' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (29, N'Foundation', CAST(N'2020-02-18T12:02:21.847' AS DateTime), CAST(N'2020-02-18T12:02:21.847' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (30, N'GSD', CAST(N'2020-02-18T12:02:21.850' AS DateTime), CAST(N'2020-02-18T12:02:21.850' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (31, N'Histopath', CAST(N'2020-02-18T12:02:21.850' AS DateTime), CAST(N'2020-02-18T12:02:21.850' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (32, N'Housekeeping', CAST(N'2020-02-18T12:02:21.853' AS DateTime), CAST(N'2020-02-18T12:02:21.853' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (33, N'Heart Station', CAST(N'2020-02-18T12:02:21.853' AS DateTime), CAST(N'2020-02-18T12:02:21.853' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (34, N'Hemo Dialysis', CAST(N'2020-02-18T12:02:21.853' AS DateTime), CAST(N'2020-02-18T12:02:21.853' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (35, N'Hearing Center', CAST(N'2020-02-18T12:02:21.857' AS DateTime), CAST(N'2020-02-18T12:02:21.857' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (36, N'IHC', CAST(N'2020-02-18T12:02:21.857' AS DateTime), CAST(N'2020-02-18T12:02:21.857' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (37, N'ICU', CAST(N'2020-02-18T12:02:21.857' AS DateTime), CAST(N'2020-02-18T12:02:21.857' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (38, N'Industrial', CAST(N'2020-02-18T12:02:21.857' AS DateTime), CAST(N'2020-02-18T12:02:21.857' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (39, N'Clinical Laboratories', CAST(N'2020-02-18T12:02:21.857' AS DateTime), CAST(N'2020-02-18T12:02:21.857' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (40, N'Marketing', CAST(N'2020-02-18T12:02:21.860' AS DateTime), CAST(N'2020-02-18T12:02:21.860' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (41, N'Medical Records', CAST(N'2020-02-18T12:02:21.860' AS DateTime), CAST(N'2020-02-18T12:02:21.860' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (42, N'MICT', CAST(N'2020-02-18T12:02:21.860' AS DateTime), CAST(N'2020-02-18T12:02:21.860' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (43, N'Medical Library', CAST(N'2020-02-18T12:02:21.863' AS DateTime), CAST(N'2020-02-18T12:02:21.863' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (44, N'Medicine', CAST(N'2020-02-18T12:02:21.863' AS DateTime), CAST(N'2020-02-18T12:02:21.863' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (45, N'Micropara', CAST(N'2020-02-18T12:02:21.863' AS DateTime), CAST(N'2020-02-18T12:02:21.863' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (46, N'MDO', CAST(N'2020-02-18T12:02:21.863' AS DateTime), CAST(N'2020-02-18T12:02:21.863' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (47, N'MSS', CAST(N'2020-02-18T12:02:21.863' AS DateTime), CAST(N'2020-02-18T12:02:21.863' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (48, N'MICU - CD', CAST(N'2020-02-18T12:02:21.867' AS DateTime), CAST(N'2020-02-18T12:02:21.867' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (49, N'MICU-Pay', CAST(N'2020-02-18T12:02:21.867' AS DateTime), CAST(N'2020-02-18T12:02:21.867' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (50, N'Medical Ward', CAST(N'2020-02-18T12:02:21.867' AS DateTime), CAST(N'2020-02-18T12:02:21.867' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (51, N'NICU', CAST(N'2020-02-18T12:02:21.867' AS DateTime), CAST(N'2020-02-18T12:02:21.867' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (52, N'Neuro', CAST(N'2020-02-18T12:02:21.867' AS DateTime), CAST(N'2020-02-18T12:02:21.867' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (53, N'NSO', CAST(N'2020-02-18T12:02:21.867' AS DateTime), CAST(N'2020-02-18T12:02:21.867' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (54, N'OB-Ward', CAST(N'2020-02-18T12:02:21.870' AS DateTime), CAST(N'2020-02-18T12:02:21.870' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (55, N'OPD-O.R', CAST(N'2020-02-18T12:02:21.870' AS DateTime), CAST(N'2020-02-18T12:02:21.870' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (56, N'OPD-ENT', CAST(N'2020-02-18T12:02:21.870' AS DateTime), CAST(N'2020-02-18T12:02:21.870' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (57, N'OPD-Ophtha', CAST(N'2020-02-18T12:02:21.870' AS DateTime), CAST(N'2020-02-18T12:02:21.870' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (58, N'OPD', CAST(N'2020-02-18T12:02:21.873' AS DateTime), CAST(N'2020-02-18T12:02:21.873' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (59, N'OB', CAST(N'2020-02-18T12:02:21.873' AS DateTime), CAST(N'2020-02-18T12:02:21.873' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (60, N'Ophtha', CAST(N'2020-02-18T12:02:21.873' AS DateTime), CAST(N'2020-02-18T12:02:21.873' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (61, N'Operating Room', CAST(N'2020-02-18T12:02:21.893' AS DateTime), CAST(N'2020-02-18T12:02:21.893' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (62, N'Pay 2', CAST(N'2020-02-18T12:02:21.897' AS DateTime), CAST(N'2020-02-18T12:02:21.897' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (63, N'Pay 4', CAST(N'2020-02-18T12:02:21.897' AS DateTime), CAST(N'2020-02-18T12:02:21.897' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (64, N'Pay 5', CAST(N'2020-02-18T12:02:21.897' AS DateTime), CAST(N'2020-02-18T12:02:21.897' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (65, N'Pain Center', CAST(N'2020-02-18T12:02:21.897' AS DateTime), CAST(N'2020-02-18T12:02:21.897' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (66, N'Pathology PBL', CAST(N'2020-02-18T12:02:21.897' AS DateTime), CAST(N'2020-02-18T12:02:21.897' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (67, N'Property & Supply', CAST(N'2020-02-18T12:02:21.897' AS DateTime), CAST(N'2020-02-18T12:02:21.897' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (68, N'Pharmacy - MedExpress', CAST(N'2020-02-18T12:02:21.897' AS DateTime), CAST(N'2020-02-18T12:02:21.897' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (69, N'Pulmo', CAST(N'2020-02-18T12:02:21.897' AS DateTime), CAST(N'2020-02-18T12:02:21.897' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (70, N'Pedia', CAST(N'2020-02-18T12:02:21.900' AS DateTime), CAST(N'2020-02-18T12:02:21.900' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (71, N'Physiology', CAST(N'2020-02-18T12:02:21.900' AS DateTime), CAST(N'2020-02-18T12:02:21.900' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (72, N'PICU', CAST(N'2020-02-18T12:02:21.900' AS DateTime), CAST(N'2020-02-18T12:02:21.900' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (73, N'Pedia Ward', CAST(N'2020-02-18T12:02:21.900' AS DateTime), CAST(N'2020-02-18T12:02:21.900' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (74, N'PDMD', CAST(N'2020-02-18T12:02:21.900' AS DateTime), CAST(N'2020-02-18T12:02:21.900' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (75, N'PSD', CAST(N'2020-02-18T12:02:21.900' AS DateTime), CAST(N'2020-02-18T12:02:21.900' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (76, N'Purchasing', CAST(N'2020-02-18T12:02:21.900' AS DateTime), CAST(N'2020-02-18T12:02:21.900' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (77, N'QAU', CAST(N'2020-02-18T12:02:21.903' AS DateTime), CAST(N'2020-02-18T12:02:21.903' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (78, N'Physical Rehab.', CAST(N'2020-02-18T12:02:21.903' AS DateTime), CAST(N'2020-02-18T12:02:21.903' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (79, N'Registrar', CAST(N'2020-02-18T12:02:21.903' AS DateTime), CAST(N'2020-02-18T12:02:21.903' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (80, N'Radiology', CAST(N'2020-02-18T12:02:21.903' AS DateTime), CAST(N'2020-02-18T12:02:21.903' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (81, N'Research', CAST(N'2020-02-18T12:02:21.903' AS DateTime), CAST(N'2020-02-18T12:02:21.903' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (82, N'SICU', CAST(N'2020-02-18T12:02:21.907' AS DateTime), CAST(N'2020-02-18T12:02:21.907' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (83, N'Surgical Ward', CAST(N'2020-02-18T12:02:21.907' AS DateTime), CAST(N'2020-02-18T12:02:21.907' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (84, N'Ultrasound', CAST(N'2020-02-18T12:02:21.907' AS DateTime), CAST(N'2020-02-18T12:02:21.907' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (85, N'View Center', CAST(N'2020-02-18T12:02:21.907' AS DateTime), CAST(N'2020-02-18T12:02:21.907' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (86, N'X-Ray', CAST(N'2020-02-18T12:02:21.907' AS DateTime), CAST(N'2020-02-18T12:02:21.907' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (87, N'Pharmacy - MCU', CAST(N'2020-02-18T12:02:21.910' AS DateTime), CAST(N'2020-02-18T12:02:21.910' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (88, N'Outside Institution', CAST(N'2020-02-18T12:02:21.910' AS DateTime), CAST(N'2020-02-18T12:02:21.910' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (89, N'Dietary-KCI', CAST(N'2020-02-18T12:02:21.910' AS DateTime), CAST(N'2020-02-18T12:02:21.910' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (90, N'Surgery Department', CAST(N'2020-02-18T12:02:21.910' AS DateTime), CAST(N'2020-02-18T12:02:21.910' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (91, N'Blood Bank', CAST(N'2020-02-18T12:02:21.910' AS DateTime), CAST(N'2020-02-18T12:02:21.910' AS DateTime))
INSERT [dbo].[departments] ([id], [dept_name], [created_at], [updated_at]) VALUES (92, N'Women''s Center', CAST(N'2020-02-19T14:45:49.710' AS DateTime), CAST(N'2020-02-19T14:45:49.710' AS DateTime))
SET IDENTITY_INSERT [dbo].[departments] OFF
SET IDENTITY_INSERT [dbo].[m_tickets] ON 

INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (1, N'Marilen', N'Accounting', N'Resolve', NULL, NULL, NULL, N'Jemuel', N'Jemuel', NULL, N'Jemuel', N'System', N'Bizbox', N'Low', N'Good AM. jem. pwede ako plagay ng access sa HIS. HMO census report. thanks..
Lascano, Ma. Marilen', NULL, N'Administrator', N'Administrator', 0, CAST(N'2020-02-17T12:01:39.557' AS DateTime), CAST(N'2020-02-18T12:04:27.790' AS DateTime), CAST(N'2020-02-17T12:05:00.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (2, N'ric', N'Pedia Ward', N'Resolve', NULL, NULL, NULL, N'Cris', N'Cris', NULL, N'Cris', N'System', N'Bizbox', N'Medium', N'Cannot connect to Bizbox', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-17T12:03:00.000' AS DateTime), CAST(N'2020-02-18T12:02:41.507' AS DateTime), CAST(N'2020-02-17T12:04:00.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (3, N'Deyah', N'Property & Supply', N'Resolve', NULL, NULL, NULL, N'Jemuel', N'Jemuel', NULL, N'Jemuel', N'System', N'Bizbox', N'Low', N'Request of  Void RR(3434) Reason No Invoice', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-17T12:04:00.000' AS DateTime), CAST(N'2020-02-18T12:03:37.023' AS DateTime), CAST(N'2020-02-17T12:05:00.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (4, N'Charlotte', N'Marketing', N'Resolve', NULL, NULL, NULL, N'Jemuel', N'Joel', NULL, N'Joel', N'Network', NULL, N'Low', N'No internet Connection', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-18T12:05:37.350' AS DateTime), CAST(N'2020-02-18T12:05:37.350' AS DateTime), CAST(N'2020-02-18T12:05:37.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (5, N'Staff', N'OPD', N'Resolve', NULL, NULL, NULL, N'Mikel', N'Joel', N'Jemuel', N'Joel', N'Software', NULL, N'Low', N'Workstation Time is not Up-to-Date', NULL, N'Administrator', N'Administrator', 0, CAST(N'2020-02-18T12:06:41.567' AS DateTime), CAST(N'2020-02-18T12:06:48.690' AS DateTime), CAST(N'2020-02-18T12:06:00.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (6, N'Angel', N'Radiology', N'Resolve', NULL, NULL, NULL, N'Joel', N'Joel', NULL, N'Joel', N'Hardware', NULL, N'Low', N'Printer not working', NULL, N'Administrator', N'Joel', 0, CAST(N'2020-02-18T12:07:15.053' AS DateTime), CAST(N'2020-02-20T14:35:30.137' AS DateTime), CAST(N'2020-02-20T14:35:30.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (7, N'Isabel Echano', N'Pay 5', N'Resolve', NULL, NULL, NULL, N'Jemuel', N'Jemuel', NULL, N'Jemuel', N'System', N'Bizbox', N'Low', N'Request to Gain access in Pay 5', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-18T13:19:59.683' AS DateTime), CAST(N'2020-02-18T13:19:59.683' AS DateTime), CAST(N'2020-02-18T13:19:59.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (8, N'Carla', N'Pharmacy - MedExpress', N'Resolve', NULL, NULL, NULL, N'Jemuel', N'Joel', NULL, NULL, N'Hardware', NULL, N'Low', N'Request to Operate Projector at Board Room', NULL, N'Jemuel', N'Jemuel', 0, CAST(N'2020-02-18T14:15:01.573' AS DateTime), CAST(N'2020-02-18T14:49:36.763' AS DateTime), CAST(N'2020-02-18T14:49:36.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (9, N'Jemuel', N'MICT', N'Resolve', NULL, NULL, NULL, N'Jemuel', N'Joel', N'Jemuel', N'Joel', N'Network', NULL, N'Medium', N'Installing Ethernet cable thru IDF2 switch #17 Port 5 & 17 to Industrial Clinic', NULL, N'Jemuel', N'Jemuel', 0, CAST(N'2020-02-18T15:17:33.727' AS DateTime), CAST(N'2020-02-18T17:49:46.223' AS DateTime), CAST(N'2020-02-18T17:49:46.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (10, N'Cris', N'ER', N'Resolve', NULL, NULL, NULL, N'Jemuel', N'Jemuel', NULL, N'Jemuel', N'System', N'Bizbox', N'Low', N'Request to Merge Account Isulat, Fidel. to Isulat Fidel', NULL, N'Jemuel', N'Administrator', 0, CAST(N'2020-02-19T17:02:46.177' AS DateTime), CAST(N'2020-02-19T17:19:45.340' AS DateTime), CAST(N'2020-02-19T17:02:00.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (11, N'Cris', N'ER', N'Resolve', NULL, NULL, NULL, N'Jemuel', N'Jemuel', NULL, N'Jemuel', N'System', N'Bizbox', N'Low', N'Request to merge victor, ibanga(No records on Inpatient, Outpatient and ER) to Victor, Ibanga Jr.', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-19T17:19:35.563' AS DateTime), CAST(N'2020-02-19T17:19:35.563' AS DateTime), CAST(N'2020-02-19T17:19:35.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (12, N'Rhiza', N'Pharmacy - MedExpress', N'Resolve', NULL, NULL, NULL, N'Jemuel', N'Jemuel', NULL, N'Jemuel', N'System', N'Bizbox', N'Low', N'Request to change price of the following medicines
MED25596 -> 685.125
MED25567 -> 946.125', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-19T17:20:50.567' AS DateTime), CAST(N'2020-02-19T17:20:50.567' AS DateTime), CAST(N'2020-02-19T17:20:50.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (13, N'Staff', N'Medical Ward', N'Resolve', NULL, NULL, NULL, N'Jemuel', N'Joel', NULL, N'Joel', N'Hardware', NULL, N'Low', N'Printer is Not Working', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-19T17:21:57.917' AS DateTime), CAST(N'2020-02-19T17:21:57.917' AS DateTime), CAST(N'2020-02-19T17:21:57.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (14, N'JI Martinez', N'Surgical Ward', N'Resolve', NULL, NULL, NULL, N'Mikel', N'Mikel', NULL, N'Mikel', N'Hardware', NULL, N'Medium', N'Printer problem', NULL, N'Administrator', N'Jemuel', 0, CAST(N'2020-02-17T08:21:00.000' AS DateTime), CAST(N'2020-02-20T14:11:17.650' AS DateTime), CAST(N'2020-02-20T14:11:17.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (15, N'Mikel', N'MICT', N'Closed', NULL, NULL, NULL, N'Mikel', N'Mikel', NULL, N'Mikel', N'Others', NULL, N'High', N'Back up database', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-17T08:22:00.000' AS DateTime), CAST(N'2020-02-20T08:21:29.097' AS DateTime), CAST(N'2020-02-20T08:21:29.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (16, N'Rhiza', N'Pharmacy - MedExpress', N'Resolve', NULL, NULL, NULL, N'Jemuel', N'Jemuel', NULL, N'Jemuel', N'System', N'Bizbox', N'Low', N'Good Afternoon po Sir,Would like to request for Bizbox code creation (as formulary) 

Item Description:	Nicardipine (Nircaru ) 10mg/ml
Generic Name:	Nicardipine 
Is PNF?:	no
Vatable (w/ vat) ;	no
Vat Exempt;	yes
Supplier ;	EL-Van Pharma
Conversion (Packaging):	10`s
Small Unit:	Piece
Big Unit:	Box
Selling Price:	1232.50', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-18T08:24:00.000' AS DateTime), CAST(N'2020-02-20T08:22:45.733' AS DateTime), CAST(N'2020-02-18T08:25:00.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (17, N'Mikel', N'MICT', N'Closed', NULL, NULL, NULL, N'Mikel', N'Mikel', NULL, N'Mikel', N'System', N'Bizbox', N'Low', N'Back up database', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-18T08:24:00.000' AS DateTime), CAST(N'2020-02-20T08:23:31.993' AS DateTime), CAST(N'2020-02-18T08:25:00.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (18, N'Mayo', N'Billing', N'On-Going', N'Under Observation', CAST(N'2020-02-18T08:25:00.000' AS DateTime), CAST(N'2020-02-25T08:26:00.000' AS DateTime), N'Mikel', N'Mikel', NULL, N'Mikel', N'System', N'Bizbox', N'Medium', N'Concern on PWD discount', NULL, N'Administrator', N'Administrator', 0, CAST(N'2020-02-18T08:25:00.000' AS DateTime), CAST(N'2020-02-20T08:24:52.267' AS DateTime), NULL)
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (19, N'cj rongcales', N'Pharmacy - MedExpress', N'Closed', NULL, NULL, NULL, N'Mikel', N'Mikel', NULL, N'Mikel', N'System', N'Bizbox', N'Medium', N'Good afternoon. Request to void Delivery room stock transfer request no. 17989 (pharmacy main) 2/18/20.
Reason: Item returned by the department/ Not carried/ wrong item requested.', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-18T08:26:00.000' AS DateTime), CAST(N'2020-02-20T08:26:20.757' AS DateTime), CAST(N'2020-02-20T08:26:20.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (20, N'CRIS ALEJANDRO', N'Pharmacy - MedExpress', N'Closed', NULL, NULL, NULL, N'Mikel', N'Mikel', NULL, N'Mikel', N'System', N'Bizbox', N'Medium', N'GOOD DAY PO SIR PASUYO LANG PO PA VOID PO AKO NG STI NO. 17994 DATE 2/18/2020 PHARMACY MAIN (EMERGENCY ROOM). UPON PRESCRIPTION PO KASI NAKALAGAY ISORDIL 10MG TAB SINUNOD  LANG PO NAMIN ANO YUNG NASA RESETA. THEN YUNG KUKUNIN NA NILA PINALITAN PO NG 5MG. DOUBLE CHECKING NAMAN PO NAMIN YUNG ITEMS YUNG NGA LANG PO NEED DAW PO NG E.R ISORDIL 5MG TAB. SALAMAT PO.', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-18T08:56:00.000' AS DateTime), CAST(N'2020-02-20T08:55:10.957' AS DateTime), CAST(N'2020-02-18T08:57:00.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (21, N'cj rongcales', N'Pharmacy - MedExpress', N'Closed', NULL, NULL, NULL, N'Mikel', N'Mikel', NULL, N'Mikel', N'System', N'Bizbox', N'Medium', N'Good evening. Pa void po ng SRS NO. 17943 (Operating room) 2/14/20 Reason: Wrong quantity of Sanmyd. Thank you po.', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-18T08:57:00.000' AS DateTime), CAST(N'2020-02-20T08:55:45.320' AS DateTime), CAST(N'2020-02-18T08:58:00.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (22, N'Shermie', N'Pharmacy - MedExpress', N'Closed', NULL, NULL, NULL, N'Mikel', N'Mikel', NULL, N'Mikel', N'System', N'Bizbox', N'Medium', N'Good morning. Magpapa-void po ng RR# 36245 RR Doc date and Date Posted on 2/18/2020. REASON: Wrong unit encoded for Glycerin suppository pedia Rhea

Thank you.', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-19T08:58:00.000' AS DateTime), CAST(N'2020-02-20T08:56:45.087' AS DateTime), CAST(N'2020-02-19T08:59:00.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (23, N'John Rick', N'Clinical Laboratories', N'Closed', NULL, NULL, NULL, N'Jemuel', N'Jemuel', NULL, N'Jemuel', N'System', N'Bizbox', N'Low', N'Request to change the price of send out #EXM22403 to 5,700 form 6,450', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-19T08:58:00.000' AS DateTime), CAST(N'2020-02-20T08:57:31.337' AS DateTime), CAST(N'2020-02-19T08:59:00.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (24, N'Optha', N'View Center', N'Closed', NULL, NULL, NULL, N'Mikel', N'Mikel', NULL, N'Mikel', N'System', N'Bizbox', N'Low', N'Add barangay  Parada, Sta. Maria Bulacan', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-19T08:59:00.000' AS DateTime), CAST(N'2020-02-20T08:58:13.397' AS DateTime), CAST(N'2020-02-19T09:00:00.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (25, N'NORA', N'Billing', N'On-Going', N'Under Observation', CAST(N'2020-02-19T09:01:00.000' AS DateTime), CAST(N'2020-02-26T09:02:00.000' AS DateTime), N'Mikel', N'Mikel', NULL, N'Mikel', N'System', N'Bizbox', N'Low', N'cANNOT CHARGE ROOM ON BABY  PATIENT VELANO, NASH GAVIN', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-19T09:01:00.000' AS DateTime), CAST(N'2020-02-20T08:59:57.797' AS DateTime), NULL)
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (26, N'Ellaine', N'Pharmacy - MedExpress', N'Resolve', NULL, NULL, NULL, N'Jemuel', NULL, NULL, N'Jemuel', N'System', N'Bizbox', N'Low', N'Good afternoon.. Pa void po ng SRS NO. 18011 (EmergencyRoom) 2/19/20 
Reason: Wrong brand of esomeprazole. Thank you po.', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-19T09:02:00.000' AS DateTime), CAST(N'2020-02-20T09:00:49.417' AS DateTime), CAST(N'2020-02-20T09:00:49.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (27, N'FLOR', N'Pharmacy - MedExpress', N'Closed', NULL, NULL, NULL, N'Jemuel', N'Jemuel', NULL, N'Jemuel', N'System', N'Bizbox', N'Low', N'Good afternoon.. Pa void po ng SRS NO. 18009 (Operating Room) 2/19/20 
Reason: Wrong ml requested (D5NSS1L). Thank you po.', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-19T09:02:00.000' AS DateTime), CAST(N'2020-02-20T09:01:23.997' AS DateTime), CAST(N'2020-02-19T09:03:00.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (28, N'Mikel', N'MICT', N'Closed', NULL, NULL, NULL, N'Mikel', N'Mikel', NULL, N'Mikel', N'Others', NULL, N'Medium', N'Back up Database', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-20T09:03:00.000' AS DateTime), CAST(N'2020-02-20T09:02:20.743' AS DateTime), CAST(N'2020-02-20T09:02:20.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (29, N'Edna', N'Billing', N'Closed', NULL, NULL, NULL, N'Mikel', N'Mikel', NULL, N'Mikel', N'System', N'Bizbox', N'Low', N'Merge double patient name   Irabagon, Benjamin', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-20T09:02:43.717' AS DateTime), CAST(N'2020-02-20T09:02:43.717' AS DateTime), CAST(N'2020-02-20T09:02:43.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (30, N'Charlotte', N'Marketing', N'Resolve', NULL, NULL, NULL, N'Jemuel', N'Joel', N'Jemuel', N'Joel', N'Network', NULL, N'Medium', N'No Internet Connection', NULL, N'Administrator', N'Joel', 0, CAST(N'2020-02-20T09:03:36.740' AS DateTime), CAST(N'2020-02-20T11:24:23.320' AS DateTime), CAST(N'2020-02-20T11:24:23.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (31, N'Dowrie', N'QAU', N'Resolve', NULL, NULL, NULL, N'Jemuel', N'Joel', NULL, N'Joel', N'Hardware', NULL, N'Medium', N'Her workstation generates loud noises', NULL, N'Jemuel', N'Joel', 0, CAST(N'2020-02-20T09:28:22.350' AS DateTime), CAST(N'2020-02-20T11:25:05.550' AS DateTime), CAST(N'2020-02-20T11:25:05.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (32, N'Ellen', N'EVP', N'Resolve', NULL, NULL, NULL, N'Cris', N'Joel', NULL, N'Joel', N'Hardware', NULL, N'Medium', N'Installation of scanner', NULL, N'Joel', N'Jemuel', 0, CAST(N'2020-02-20T10:57:38.017' AS DateTime), CAST(N'2020-02-20T11:21:17.990' AS DateTime), CAST(N'2020-02-20T11:21:17.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (33, N'Dorie', N'QAU', N'Resolve', NULL, NULL, NULL, N'Joel', N'Joel', NULL, N'Joel', N'Software', NULL, N'Medium', N'Pictures of ground breaking ceremony.', NULL, N'Joel', N'Joel', 0, CAST(N'2020-02-20T11:01:54.257' AS DateTime), CAST(N'2020-02-20T14:32:35.727' AS DateTime), CAST(N'2020-02-20T14:32:35.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (34, N'Rose', N'Pharmacy - MedExpress', N'Resolve', NULL, NULL, NULL, N'Jemuel', N'Jemuel', NULL, N'Jemuel', N'System', N'Bizbox', N'Low', N'good morning po sir papavoid po ng RR
RR# 36270
Reason : Wrong Supplier 

Thanks po', NULL, N'Jemuel', NULL, 0, CAST(N'2020-02-20T11:21:58.853' AS DateTime), CAST(N'2020-02-20T11:21:58.853' AS DateTime), CAST(N'2020-02-20T11:21:58.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (35, N'Staff', N'CCU', N'Resolve', NULL, NULL, NULL, N'Jemuel', N'Joel', NULL, N'Joel', N'System', N'Bizbox', N'Medium', N'Printer is not working/printing', NULL, N'Jemuel', N'Joel', 0, CAST(N'2020-02-20T14:11:53.367' AS DateTime), CAST(N'2020-02-20T14:23:21.897' AS DateTime), CAST(N'2020-02-20T14:23:21.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (36, N'Charlotte', N'Marketing', N'Resolve', NULL, NULL, NULL, N'Joel', NULL, NULL, N'Joel', N'Software', NULL, N'Medium', N'Copy of pictures  of ground breaking ceremony', NULL, N'Joel', N'Joel', 0, CAST(N'2020-02-20T14:29:42.910' AS DateTime), CAST(N'2020-02-20T14:31:23.997' AS DateTime), CAST(N'2020-02-20T14:31:23.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (37, N'Angel', N'Radiology', N'On-Going', N'Pending For Spare', CAST(N'2020-02-15T15:03:00.000' AS DateTime), CAST(N'2020-03-14T15:04:00.000' AS DateTime), N'Joel', N'Cris', N'Joel', N'Cris', N'Hardware', NULL, N'Medium', N'System unit not functioning.', N'System unit power supply is defective which in turn affected the Hard Disk Drive because of the overvoltage coming from the power supply unit. Power supply unit and Hard Disk Drive for replacement.', N'Cris', N'Joel', 0, CAST(N'2020-02-20T15:04:13.473' AS DateTime), CAST(N'2020-02-21T14:02:48.840' AS DateTime), NULL)
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (38, N'Tonette', N'Surgery Department', N'Resolve', NULL, NULL, NULL, N'Joel', NULL, NULL, N'Joel', N'Hardware', NULL, N'Medium', N'AV set-up for their conference.', NULL, N'Joel', N'Joel', 0, CAST(N'2020-02-21T14:04:28.613' AS DateTime), CAST(N'2020-02-21T14:09:22.897' AS DateTime), CAST(N'2020-02-21T14:09:22.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (39, N'Staff', N'Operating Room', N'Resolve', NULL, NULL, NULL, N'Joel', NULL, NULL, N'Joel', N'Software', NULL, N'Medium', N'Back-up of files.', NULL, N'Joel', N'Joel', 0, CAST(N'2020-02-21T14:05:43.707' AS DateTime), CAST(N'2020-02-21T14:09:38.497' AS DateTime), CAST(N'2020-02-21T14:09:38.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (40, N'Monette', N'Medicine', N'Resolve', NULL, NULL, NULL, N'Joel', NULL, NULL, N'Joel', N'Hardware', NULL, N'Medium', N'AV set-up for their conference.', NULL, N'Joel', N'Joel', 0, CAST(N'2020-02-21T14:07:34.840' AS DateTime), CAST(N'2020-02-21T14:09:54.867' AS DateTime), CAST(N'2020-02-21T14:09:54.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (41, N'Monette', N'Medicine', N'Resolve', NULL, NULL, NULL, N'Joel', NULL, NULL, N'Joel', N'Hardware', NULL, N'Medium', N'Safe-keeping of AV equipment.', NULL, N'Joel', N'Joel', 0, CAST(N'2020-02-21T14:08:42.657' AS DateTime), CAST(N'2020-02-21T14:10:33.273' AS DateTime), CAST(N'2020-02-21T14:10:33.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (42, N'Malen', N'Accounting', N'Active', NULL, NULL, NULL, N'Jemuel', N'Joel', NULL, NULL, N'Hardware', NULL, N'Low', N'Request to re plugged  all cable from Ma''am Malen''s Workstation', NULL, N'Jemuel', NULL, 0, CAST(N'2020-02-21T14:49:37.373' AS DateTime), CAST(N'2020-02-21T14:50:59.623' AS DateTime), NULL)
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (43, N'Rhodora Tongco', N'OPD', N'Resolve', NULL, NULL, NULL, N'Jemuel', N'Jemuel', NULL, N'Jemuel', N'System', N'Bizbox', N'Low', N'Request to gain access to MMS (SR & ER)', NULL, N'Jemuel', NULL, 0, CAST(N'2020-02-21T14:50:48.137' AS DateTime), CAST(N'2020-02-21T14:50:48.137' AS DateTime), CAST(N'2020-02-21T14:50:48.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (44, N'Mikel', N'MICT', N'Closed', NULL, NULL, NULL, N'Mikel', NULL, NULL, N'Mikel', N'Others', NULL, N'Low', N'Back up database', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-21T14:52:18.087' AS DateTime), CAST(N'2020-02-21T14:52:18.087' AS DateTime), CAST(N'2020-02-21T14:52:18.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (45, N'Vi', N'MICT', N'Closed', NULL, NULL, NULL, N'Mikel', NULL, NULL, N'Mikel', N'System', N'Bizbox', N'Low', N'USB - reformat', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-21T14:53:12.153' AS DateTime), CAST(N'2020-02-21T14:53:12.153' AS DateTime), CAST(N'2020-02-21T14:53:12.000' AS DateTime))
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (46, N'Riza', N'Pharmacy - MedExpress', N'Active', NULL, NULL, NULL, N'Mikel', NULL, NULL, N'Mikel', N'System', N'Bizbox', N'Low', N'Cannot void PR  10392', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-21T14:53:53.147' AS DateTime), CAST(N'2020-02-21T14:53:58.330' AS DateTime), NULL)
INSERT [dbo].[m_tickets] ([id], [reported_by], [request_by], [status], [og_status], [start_at], [end_at], [acknowledge_by], [assigned_to], [assisted_by], [accomplished_by], [category], [sys_category], [lop], [concerns], [recommendation], [created_by], [updated_by], [is_new], [created_at], [updated_at], [finished_at]) VALUES (47, N'Rhiza', N'Pharmacy - MedExpress', N'Closed', NULL, NULL, NULL, N'Jemuel', NULL, NULL, N'Jemuel', N'System', N'Bizbox', N'Low', N'Good morning sir, ppapvoid lang po ng PR, date PR 2/19/2020  pr # 10392
Reason po, wrong department requesting
Thank you po', NULL, N'Administrator', NULL, 0, CAST(N'2020-02-21T14:54:32.727' AS DateTime), CAST(N'2020-02-21T14:54:32.727' AS DateTime), CAST(N'2020-02-21T14:54:32.000' AS DateTime))
SET IDENTITY_INSERT [dbo].[m_tickets] OFF
SET IDENTITY_INSERT [dbo].[mactions] ON 

INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (1, N'<p>Done</p>', 1, 1, 0, CAST(N'2020-02-18T12:01:45.097' AS DateTime), CAST(N'2020-02-18T12:01:45.097' AS DateTime))
INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (2, N'<p>re-Plugged Ethernet cable</p>', 2, 1, 0, CAST(N'2020-02-18T12:02:41.513' AS DateTime), CAST(N'2020-02-18T12:02:41.513' AS DateTime))
INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (3, N'<p>Done</p>', 3, 1, 0, CAST(N'2020-02-18T12:03:37.030' AS DateTime), CAST(N'2020-02-18T12:03:37.030' AS DateTime))
INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (4, N'<p>Re plugged Ethernet cable</p>', 4, 1, 0, CAST(N'2020-02-18T12:05:37.357' AS DateTime), CAST(N'2020-02-18T12:05:37.357' AS DateTime))
INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (5, N'<p>Done</p>', 5, 1, 0, CAST(N'2020-02-18T12:06:48.687' AS DateTime), CAST(N'2020-02-18T12:06:48.687' AS DateTime))
INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (6, N'<p>Done</p>', 7, 1, 0, CAST(N'2020-02-18T13:19:59.690' AS DateTime), CAST(N'2020-02-18T13:19:59.690' AS DateTime))
INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (7, N'<p>Installing Ethernet cable thru IDF2 switch #17 Port 5 &amp; 17 to Industrial Clinic&nbsp;</p><p>(Port 5 (Vlan 40) Bizbox Ip Address : 192.168.40.150)</p><p>(Port 17 (Vlan 60) Ip Address: 192.168.60.117)</p>', 9, 2, 0, CAST(N'2020-02-18T15:17:33.733' AS DateTime), CAST(N'2020-02-18T15:17:33.733' AS DateTime))
INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (8, N'<p>Done</p>', 10, 2, 0, CAST(N'2020-02-19T17:02:46.180' AS DateTime), CAST(N'2020-02-19T17:02:46.180' AS DateTime))
INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (9, N'<p>Re plugged the printer</p>', 13, 1, 0, CAST(N'2020-02-19T17:21:57.923' AS DateTime), CAST(N'2020-02-19T17:21:57.923' AS DateTime))
INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (10, N'<p>Done</p>', 16, 1, 1, CAST(N'2020-02-20T08:22:45.743' AS DateTime), CAST(N'2020-02-20T08:22:45.743' AS DateTime))
INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (11, N'Done', 20, 1, 0, CAST(N'2020-02-20T08:55:10.963' AS DateTime), CAST(N'2020-02-20T08:55:10.963' AS DateTime))
INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (12, N'<p>Done</p>', 21, 1, 1, CAST(N'2020-02-20T08:55:45.323' AS DateTime), CAST(N'2020-02-20T08:55:45.323' AS DateTime))
INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (13, N'<p>Done</p>', 22, 1, 0, CAST(N'2020-02-20T08:56:45.093' AS DateTime), CAST(N'2020-02-20T08:56:45.093' AS DateTime))
INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (14, N'<p>Done</p>', 23, 1, 1, CAST(N'2020-02-20T08:57:31.340' AS DateTime), CAST(N'2020-02-20T08:57:31.340' AS DateTime))
INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (15, N'<p>Done</p>', 26, 1, 0, CAST(N'2020-02-20T09:00:49.423' AS DateTime), CAST(N'2020-02-20T09:00:49.423' AS DateTime))
INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (16, N'<p>Termination of cable.</p>', 30, 4, 0, CAST(N'2020-02-20T11:24:23.307' AS DateTime), CAST(N'2020-02-20T11:24:23.307' AS DateTime))
INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (17, N'<p>Had given a copy using flash drive.</p>', 36, 4, 0, CAST(N'2020-02-20T14:31:23.990' AS DateTime), CAST(N'2020-02-20T14:31:23.990' AS DateTime))
INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (18, N'<p>Copy&nbsp; provided..</p>', 33, 4, 0, CAST(N'2020-02-20T14:32:35.723' AS DateTime), CAST(N'2020-02-20T14:32:35.723' AS DateTime))
INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (19, N'<p>Checked system unit for defects.</p>', 37, 3, 0, CAST(N'2020-02-20T15:13:09.830' AS DateTime), CAST(N'2020-02-20T15:13:09.830' AS DateTime))
INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (20, N'<p>Done</p>', 41, 2, 1, CAST(N'2020-02-21T14:50:48.210' AS DateTime), CAST(N'2020-02-21T14:50:48.210' AS DateTime))
INSERT [dbo].[mactions] ([id], [actions], [id_mticket], [id_user], [shared], [created_at], [updated_at]) VALUES (21, N'<p>Done</p>', 45, 1, 1, CAST(N'2020-02-21T14:54:32.733' AS DateTime), CAST(N'2020-02-21T14:54:32.733' AS DateTime))
SET IDENTITY_INSERT [dbo].[mactions] OFF
SET IDENTITY_INSERT [dbo].[mcomments] ON 

INSERT [dbo].[mcomments] ([id], [comments], [id_mticket], [id_user], [created_at], [updated_at]) VALUES (1, N'for monitoring', 18, 1, CAST(N'2020-02-20T08:24:52.257' AS DateTime), CAST(N'2020-02-20T08:24:52.257' AS DateTime))
INSERT [dbo].[mcomments] ([id], [comments], [id_mticket], [id_user], [created_at], [updated_at]) VALUES (2, N'Have to terminate cable.', 30, 4, CAST(N'2020-02-20T11:24:23.313' AS DateTime), CAST(N'2020-02-20T11:24:23.313' AS DateTime))
INSERT [dbo].[mcomments] ([id], [comments], [id_mticket], [id_user], [created_at], [updated_at]) VALUES (3, N'Provided Service unit for the mean time.', 37, 4, CAST(N'2020-02-21T14:02:48.813' AS DateTime), CAST(N'2020-02-21T14:02:48.813' AS DateTime))
SET IDENTITY_INSERT [dbo].[mcomments] OFF
SET IDENTITY_INSERT [dbo].[migrations] ON 

INSERT [dbo].[migrations] ([id], [migration], [batch]) VALUES (1, N'2014_10_12_000000_create_users_table', 1)
INSERT [dbo].[migrations] ([id], [migration], [batch]) VALUES (2, N'2020_01_07_010147_create_departments_table', 1)
INSERT [dbo].[migrations] ([id], [migration], [batch]) VALUES (3, N'2020_01_15_165633_create_mtickets_table', 1)
INSERT [dbo].[migrations] ([id], [migration], [batch]) VALUES (4, N'2020_01_16_232630_create_mcomments_table', 1)
INSERT [dbo].[migrations] ([id], [migration], [batch]) VALUES (5, N'2020_01_16_232842_create_mactions_table', 1)
SET IDENTITY_INSERT [dbo].[migrations] OFF
SET IDENTITY_INSERT [dbo].[users] ON 

INSERT [dbo].[users] ([id], [username], [fname], [lname], [department], [password], [remember_token], [created_at], [updated_at]) VALUES (1, N'Administrator', N'Administrator', N'MCU', N'Administrator', N'$2y$10$3n25vPbMH3fCcUCeK33RKOHoebP8/hh4xoONfHBTelflpXIud8HdK', NULL, CAST(N'2020-02-18T12:02:21.963' AS DateTime), CAST(N'2020-02-18T12:02:21.963' AS DateTime))
INSERT [dbo].[users] ([id], [username], [fname], [lname], [department], [password], [remember_token], [created_at], [updated_at]) VALUES (2, N'Jemuel', N'Jemuel', N'Amerila', N'MICT', N'$2y$10$HtXQnMEesR0Pw7SnAwXkZOxrFyjr0laOnhrJENvPZaiIQjg4sCv/e', NULL, CAST(N'2020-02-18T12:02:22.010' AS DateTime), CAST(N'2020-02-18T12:02:22.010' AS DateTime))
INSERT [dbo].[users] ([id], [username], [fname], [lname], [department], [password], [remember_token], [created_at], [updated_at]) VALUES (3, N'cris', N'Cris', N'Dela Cruz', N'MICT', N'$2y$10$WFjDUGxaVl4qkTxX97MLy.8LUpZ9jYR/pSTXIq.rjjsv6zYkmCLta', NULL, CAST(N'2020-02-18T12:02:22.013' AS DateTime), CAST(N'2020-02-18T12:02:22.013' AS DateTime))
INSERT [dbo].[users] ([id], [username], [fname], [lname], [department], [password], [remember_token], [created_at], [updated_at]) VALUES (4, N'joel', N'Joel', N'Pamatian', N'MICT', N'$2y$10$xdeLNO16zsSlMILFz9ZF8ewazeNbt3HxV968zhcmu8zkr6txG0ZDe', NULL, CAST(N'2020-02-18T12:02:22.013' AS DateTime), CAST(N'2020-02-18T12:02:22.013' AS DateTime))
INSERT [dbo].[users] ([id], [username], [fname], [lname], [department], [password], [remember_token], [created_at], [updated_at]) VALUES (5, N'mikel', N'Mikel', N'Cuyugan', N'MICT', N'$2y$10$TUVeSX93xkGR/ybnPft0oubar9H0Q17XgyQk7JXNRf2BL9hc2I5SW', NULL, CAST(N'2020-02-18T12:02:22.017' AS DateTime), CAST(N'2020-02-18T12:02:22.017' AS DateTime))
INSERT [dbo].[users] ([id], [username], [fname], [lname], [department], [password], [remember_token], [created_at], [updated_at]) VALUES (6, N'MCU', N'MCU', N'MCU', N'Admin', N'$2y$10$JzAIVcgIoMLYcKpWj16Rhudv9UAV0/ngkIge4E1zgkgTR9dXzN/8W', NULL, CAST(N'2020-02-18T12:02:22.063' AS DateTime), CAST(N'2020-02-18T12:02:22.063' AS DateTime))
SET IDENTITY_INSERT [dbo].[users] OFF
SET ANSI_PADDING ON
GO
/****** Object:  Index [departments_dept_name_unique]    Script Date: 02/21/2020 4:40:53 PM ******/
CREATE UNIQUE NONCLUSTERED INDEX [departments_dept_name_unique] ON [dbo].[departments]
(
	[dept_name] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [users_username_unique]    Script Date: 02/21/2020 4:40:53 PM ******/
CREATE UNIQUE NONCLUSTERED INDEX [users_username_unique] ON [dbo].[users]
(
	[username] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
GO
ALTER TABLE [dbo].[m_tickets] ADD  DEFAULT ('1') FOR [is_new]
GO
ALTER TABLE [dbo].[mactions] ADD  DEFAULT ('0') FOR [shared]
GO
USE [master]
GO
ALTER DATABASE [MCU_MICT] SET  READ_WRITE 
GO
