<?php

/*  PEL: PHP EXIF Library.  A library with support for reading and
 *  writing all EXIF headers in JPEG and TIFF images using PHP.
 *
 *  Copyright (C) 2005  Martin Geisler.
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program in the file COPYING; if not, write to the
 *  Free Software Foundation, Inc., 59 Temple Place, Suite 330,
 *  Boston, MA 02111-1307 USA
 */

/* $Id$ */


class olympus_c50z extends UnitTestCase {

  function __construct() {
    require_once('../PelJpeg.php');
    parent::__construct('PEL olympus-c50z.jpg Tests');
  }

  function testRead() {
    $jpeg = new PelJpeg();
    $jpeg->loadFile(dirname(__FILE__) . '/olympus-c50z.jpg');

    $app1 = $jpeg->getSection(PelJpegMarker::APP1);
    $this->assertIsA($app1, 'PelExif');
    
    $tiff = $app1->getTiff();
    $this->assertIsA($tiff, 'PelTiff');
    
    /* The first IFD. */
    $ifd0 = $tiff->getIfd();
    $this->assertIsA($ifd0, 'PelIfd');
    
    /* Start of IDF $ifd0. */
    $this->assertEqual(count($ifd0->getEntries()), 11);
    
    $entry = $ifd0->getEntry(270); // ImageDescription
    $this->assertIsA($entry, 'PelEntryAscii');
    $this->assertEqual($entry->getValue(), 'OLYMPUS DIGITAL CAMERA         ');
    $this->assertEqual($entry->getText(), 'OLYMPUS DIGITAL CAMERA         ');
    
    $entry = $ifd0->getEntry(271); // Make
    $this->assertIsA($entry, 'PelEntryAscii');
    $this->assertEqual($entry->getValue(), 'OLYMPUS OPTICAL CO.,LTD');
    $this->assertEqual($entry->getText(), 'OLYMPUS OPTICAL CO.,LTD');
    
    $entry = $ifd0->getEntry(272); // Model
    $this->assertIsA($entry, 'PelEntryAscii');
    $this->assertEqual($entry->getValue(), 'X-2,C-50Z       ');
    $this->assertEqual($entry->getText(), 'X-2,C-50Z       ');
    
    $entry = $ifd0->getEntry(274); // Orientation
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 1);
    $this->assertEqual($entry->getText(), 'top - left');
    
    $entry = $ifd0->getEntry(282); // XResolution
    $this->assertIsA($entry, 'PelEntryRational');
    $this->assertEqual($entry->getValue(), array (
  0 => 144,
  1 => 1,
));
    $this->assertEqual($entry->getText(), '144/1');
    
    $entry = $ifd0->getEntry(283); // YResolution
    $this->assertIsA($entry, 'PelEntryRational');
    $this->assertEqual($entry->getValue(), array (
  0 => 144,
  1 => 1,
));
    $this->assertEqual($entry->getText(), '144/1');
    
    $entry = $ifd0->getEntry(296); // ResolutionUnit
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 2);
    $this->assertEqual($entry->getText(), 'Inch');
    
    $entry = $ifd0->getEntry(305); // Software
    $this->assertIsA($entry, 'PelEntryAscii');
    $this->assertEqual($entry->getValue(), '28-1012                        ');
    $this->assertEqual($entry->getText(), '28-1012                        ');
    
    $entry = $ifd0->getEntry(306); // DateTime
    $this->assertIsA($entry, 'PelEntryTime');
    $this->assertEqual($entry->getValue(), -1);
    $this->assertEqual($entry->getText(), '1969:12:31 23:59:59');
    
    $entry = $ifd0->getEntry(531); // YCbCrPositioning
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 2);
    $this->assertEqual($entry->getText(), 'co-sited');
    
    $entry = $ifd0->getEntry(50341); // Unknown: 0xC4A5
    $this->assertIsA($entry, 'PelEntryUndefined');
    $this->assertEqual($entry->getValue(), 'PrintIM 0250           �             	     
      �              �       �   �   �   �   �   �   ��� �   	  \'    \'  �  \'  �  \'    \'  ^  \'  �   \'  �  \'  �  \'                                      ');
    $this->assertEqual($entry->getText(), '(undefined)');
    
    /* Sub IFDs of $ifd0. */
    $this->assertEqual(count($ifd0->getSubIfds()), 1);
    $ifd0_0 = $ifd0->getSubIfd(34665); // ExifIFDPointer
    $this->assertIsA($ifd0_0, 'PelIfd');
    
    /* Start of IDF $ifd0_0. */
    $this->assertEqual(count($ifd0_0->getEntries()), 30);
    
    $entry = $ifd0_0->getEntry(33434); // ExposureTime
    $this->assertIsA($entry, 'PelEntryRational');
    $this->assertEqual($entry->getValue(), array (
  0 => 1,
  1 => 80,
));
    $this->assertEqual($entry->getText(), '1/80 sec.');
    
    $entry = $ifd0_0->getEntry(33437); // FNumber
    $this->assertIsA($entry, 'PelEntryRational');
    $this->assertEqual($entry->getValue(), array (
  0 => 45,
  1 => 10,
));
    $this->assertEqual($entry->getText(), 'f/4.5');
    
    $entry = $ifd0_0->getEntry(34850); // ExposureProgram
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 5);
    $this->assertEqual($entry->getText(), 'Creative program (biased toward depth of field)');
    
    $entry = $ifd0_0->getEntry(34855); // ISOSpeedRatings
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 80);
    $this->assertEqual($entry->getText(), '80');
    
    $entry = $ifd0_0->getEntry(36864); // ExifVersion
    $this->assertIsA($entry, 'PelEntryVersion');
    $this->assertEqual($entry->getValue(), 2.2);
    $this->assertEqual($entry->getText(), 'Exif Version 2.2');
    
    $entry = $ifd0_0->getEntry(36867); // DateTimeOriginal
    $this->assertIsA($entry, 'PelEntryTime');
    $this->assertEqual($entry->getValue(), -1);
    $this->assertEqual($entry->getText(), '1969:12:31 23:59:59');
    
    $entry = $ifd0_0->getEntry(36868); // DateTimeDigitized
    $this->assertIsA($entry, 'PelEntryTime');
    $this->assertEqual($entry->getValue(), -1);
    $this->assertEqual($entry->getText(), '1969:12:31 23:59:59');
    
    $entry = $ifd0_0->getEntry(37121); // ComponentsConfiguration
    $this->assertIsA($entry, 'PelEntryUndefined');
    $this->assertEqual($entry->getValue(), ' ');
    $this->assertEqual($entry->getText(), 'Y Cb Cr -');
    
    $entry = $ifd0_0->getEntry(37380); // ExposureBiasValue
    $this->assertIsA($entry, 'PelEntrySRational');
    $this->assertEqual($entry->getValue(), array (
  0 => 0,
  1 => 10,
));
    $this->assertEqual($entry->getText(), '0.0');
    
    $entry = $ifd0_0->getEntry(37381); // MaxApertureValue
    $this->assertIsA($entry, 'PelEntryRational');
    $this->assertEqual($entry->getValue(), array (
  0 => 300,
  1 => 100,
));
    $this->assertEqual($entry->getText(), '300/100');
    
    $entry = $ifd0_0->getEntry(37383); // MeteringMode
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 5);
    $this->assertEqual($entry->getText(), 'Pattern');
    
    $entry = $ifd0_0->getEntry(37384); // LightSource
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 0);
    $this->assertEqual($entry->getText(), 'Unknown');
    
    $entry = $ifd0_0->getEntry(37385); // Flash
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 25);
    $this->assertEqual($entry->getText(), 'Flash fired, auto mode.');
    
    $entry = $ifd0_0->getEntry(37386); // FocalLength
    $this->assertIsA($entry, 'PelEntryRational');
    $this->assertEqual($entry->getValue(), array (
  0 => 1883,
  1 => 100,
));
    $this->assertEqual($entry->getText(), '18.8 mm');
    
    $entry = $ifd0_0->getEntry(37500); // MakerNote
    $this->assertIsA($entry, 'PelEntryUndefined');
    $this->assertEqual($entry->getValue(), 'OLYMP  >      $                             8      @      H      T  	     Z   
    |  
    �  
    �  
    �                  
    �  	       
                    �       Q    Q                 	   6      H                              p    p@     &@      �                      �                          !    �\'  "     n#
      $    6   %
    (  &        \'        (      d)      *      +    T  ,    
   -       .     
  /    �  0       1    t  3 �  �  8        ;    !�<    �  =
    �  >
    �      ');
    $this->assertEqual($entry->getText(), '758 bytes unknown MakerNote data');
    
    $entry = $ifd0_0->getEntry(37510); // UserComment
    $this->assertIsA($entry, 'PelEntryUndefined');
    $this->assertEqual($entry->getValue(), '                                                                                                                     ');
    $this->assertEqual($entry->getText(), '                                                                                                                     ');
    
    $entry = $ifd0_0->getEntry(40960); // FlashPixVersion
    $this->assertIsA($entry, 'PelEntryVersion');
    $this->assertEqual($entry->getValue(), 1);
    $this->assertEqual($entry->getText(), 'FlashPix Version 1.0');
    
    $entry = $ifd0_0->getEntry(40961); // ColorSpace
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 1);
    $this->assertEqual($entry->getText(), 'sRGB');
    
    $entry = $ifd0_0->getEntry(40962); // PixelXDimension
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 2560);
    $this->assertEqual($entry->getText(), '2560');
    
    $entry = $ifd0_0->getEntry(40963); // PixelYDimension
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 1920);
    $this->assertEqual($entry->getText(), '1920');
    
    $entry = $ifd0_0->getEntry(41728); // FileSource
    $this->assertIsA($entry, 'PelEntryUndefined');
    $this->assertEqual($entry->getValue(), '');
    $this->assertEqual($entry->getText(), 'DSC');
    
    $entry = $ifd0_0->getEntry(41985); // CustomRendered
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 0);
    $this->assertEqual($entry->getText(), 'Normal process');
    
    $entry = $ifd0_0->getEntry(41986); // ExposureMode
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 0);
    $this->assertEqual($entry->getText(), 'Auto exposure');
    
    $entry = $ifd0_0->getEntry(41987); // WhiteBalance
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 0);
    $this->assertEqual($entry->getText(), 'Auto white balance');
    
    $entry = $ifd0_0->getEntry(41988); // DigitalZoomRatio
    $this->assertIsA($entry, 'PelEntryRational');
    $this->assertEqual($entry->getValue(), array (
  0 => 100,
  1 => 100,
));
    $this->assertEqual($entry->getText(), '100/100');
    
    $entry = $ifd0_0->getEntry(41990); // SceneCaptureType
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 2);
    $this->assertEqual($entry->getText(), 'Portrait');
    
    $entry = $ifd0_0->getEntry(41991); // GainControl
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 0);
    $this->assertEqual($entry->getText(), 'Normal');
    
    $entry = $ifd0_0->getEntry(41992); // Contrast
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 0);
    $this->assertEqual($entry->getText(), 'Normal');
    
    $entry = $ifd0_0->getEntry(41993); // Saturation
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 0);
    $this->assertEqual($entry->getText(), 'Normal');
    
    $entry = $ifd0_0->getEntry(41994); // Sharpness
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 0);
    $this->assertEqual($entry->getText(), 'Normal');
    
    /* Sub IFDs of $ifd0_0. */
    $this->assertEqual(count($ifd0_0->getSubIfds()), 1);
    $ifd0_0_0 = $ifd0_0->getSubIfd(40965); // InteroperabilityIFDPointer
    $this->assertIsA($ifd0_0_0, 'PelIfd');
    
    /* Start of IDF $ifd0_0_0. */
    $this->assertEqual(count($ifd0_0_0->getEntries()), 2);
    
    $entry = $ifd0_0_0->getEntry(1); // InteroperabilityIndex
    $this->assertIsA($entry, 'PelEntryAscii');
    $this->assertEqual($entry->getValue(), 'R98');
    $this->assertEqual($entry->getText(), 'R98');
    
    $entry = $ifd0_0_0->getEntry(2); // InteroperabilityVersion
    $this->assertIsA($entry, 'PelEntryVersion');
    $this->assertEqual($entry->getValue(), 1);
    $this->assertEqual($entry->getText(), 'Interoperability Version 1.0');
    
    /* Sub IFDs of $ifd0_0_0. */
    $this->assertEqual(count($ifd0_0_0->getSubIfds()), 0);
    
    $this->assertEqual($ifd0_0_0->getThumbnailData(), '');
    
    /* Next IFD. */
    $ifd0_0_1 = $ifd0_0_0->getNextIfd();
    $this->assertNull($ifd0_0_1);
    /* End of IFD $ifd0_0_0. */
    
    $this->assertEqual($ifd0_0->getThumbnailData(), '');
    
    /* Next IFD. */
    $ifd0_1 = $ifd0_0->getNextIfd();
    $this->assertNull($ifd0_1);
    /* End of IFD $ifd0_0. */
    
    $this->assertEqual($ifd0->getThumbnailData(), '');
    
    /* Next IFD. */
    $ifd1 = $ifd0->getNextIfd();
    $this->assertIsA($ifd1, 'PelIfd');
    /* End of IFD $ifd0. */
    
    /* Start of IDF $ifd1. */
    $this->assertEqual(count($ifd1->getEntries()), 4);
    
    $entry = $ifd1->getEntry(259); // Compression
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 6);
    $this->assertEqual($entry->getText(), 'JPEG compression');
    
    $entry = $ifd1->getEntry(282); // XResolution
    $this->assertIsA($entry, 'PelEntryRational');
    $this->assertEqual($entry->getValue(), array (
  0 => 72,
  1 => 1,
));
    $this->assertEqual($entry->getText(), '72/1');
    
    $entry = $ifd1->getEntry(283); // YResolution
    $this->assertIsA($entry, 'PelEntryRational');
    $this->assertEqual($entry->getValue(), array (
  0 => 72,
  1 => 1,
));
    $this->assertEqual($entry->getText(), '72/1');
    
    $entry = $ifd1->getEntry(296); // ResolutionUnit
    $this->assertIsA($entry, 'PelEntryShort');
    $this->assertEqual($entry->getValue(), 2);
    $this->assertEqual($entry->getText(), 'Inch');
    
    /* Sub IFDs of $ifd1. */
    $this->assertEqual(count($ifd1->getSubIfds()), 0);
    
    $thumb_data = file_get_contents(dirname(__FILE__) .
                                    '/olympus-c50z-thumb.jpg');
    $this->assertEqual($ifd1->getThumbnailData(), $thumb_data);
    
    /* Next IFD. */
    $ifd2 = $ifd1->getNextIfd();
    $this->assertNull($ifd2);
    /* End of IFD $ifd1. */
    
  }
}

?>
